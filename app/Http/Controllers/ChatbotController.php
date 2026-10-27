<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'status'  => 'error',
                'reply'   => 'مفتاح GEMINI_API_KEY غير موجود في ملف .env'
            ], 200);
        }

        // تم التحديث إلى gemini-3.6-flash
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($url, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $request->message]
                            ]
                        ]
                    ]
                ]);

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                return response()->json([
                    'status' => 'success',
                    'reply'  => $responseData['candidates'][0]['content']['parts'][0]['text']
                ]);
            }

            $errorMessage = $responseData['error']['message'] ?? 'خطأ غير معروف من Google API';
            
            return response()->json([
                'status' => 'error',
                'reply'  => 'خطأ من Google: ' . $errorMessage
            ], 200);

        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'reply'   => 'حدث خطأ في السيرفر الداخلي: ' . $e->getMessage()
            ], 200);
        }
    }
}