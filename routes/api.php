<?php

use App\Http\Controllers\Api\ApiMovieController as ControllersApiMovieController;
use App\Http\Controllers\Api\ApiWatchListController as ControllersApiWatchListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/movies", [ControllersApiMovieController::class, "index"]);

Route::get("/movies/{id}", [ControllersApiMovieController::class, "show"]);

Route::post("/movies", [ControllersApiMovieController::class, "store"]);

Route::put("/movies/{id}", [ControllersApiMovieController::class, "update"]);

Route::delete("/movies/{id}", [ControllersApiMovieController::class, "destroy"]);




Route::get('/watchlist', [ControllersApiWatchListController::class, 'index']);

Route::post('/watchlist', [ControllersApiWatchListController::class, 'store']);

Route::get('/watchlist/check', [ControllersApiWatchListController::class, 'check']);

Route::delete('/watchlist/{id}', [ControllersApiWatchListController::class, 'destroy']);


// Route::post('/chat', function (Request $request) {
//     $apiKey = env('GEMINI_API_KEY');
//     if (empty($apiKey)) {
//         return response()->json(['error' => 'API key missing'], 500);
//     }

//     // Force the cert path at runtime
//     $certPath = 'C:\php83\extras\ssl\cacert.pem';
//     if (file_exists($certPath)) {
//         ini_set('curl.cainfo', $certPath);
//         ini_set('openssl.cafile', $certPath);
//     }

//     $response = Http::withOptions([
//         'verify' => file_exists($certPath) ? $certPath : false,
//     ])->post(
//         "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}",
//         ['contents' => [['parts' => [['text' => $request->input('question')]]]]]
//     );

//     if ($response->failed()) {
//         return response()->json(['gemini_error' => $response->json() ?: $response->body()], 500);
//     }

//     $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'no reply';

//     return response()->json([
//         'choices' => [[ 'message' => ['role' => 'assistant', 'content' => $text] ]]
//     ]);
// });

// Route::get('/phpinfo', function () {
//     return response()->json([
//         'ini_file' => php_ini_loaded_file(),
//         'ini_scanned' => php_ini_scanned_files(),
//     ]);
// });