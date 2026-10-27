<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WatchList;
use Illuminate\Http\Request;

class ApiWatchListController extends Controller
{
    /**
     * Get all movies in a device's watchList.
     * GET /api/watchList?device_id=xxxx
     */
    public function index(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string',
        ]);

        $watchList = WatchList::where('device_id', $request->device_id)
            ->with('movie')
            ->latest()
            ->get();

        return response()->json([
            'isOk' => true,
            'data' => $watchList,
        ], 200);
    }

    /**
     * Add a movie to the watchList.
     * POST /api/watchList
     */
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string',
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Prevent duplicate entries for the same device + movie
        $watchList = WatchList::firstOrCreate([
            'device_id' => $request->device_id,
            'movie_id' => $request->movie_id,
        ]);

        return response()->json([
            'isOk' => true,
            'message' => 'Movie added to watchList',
            'data' => $watchList->load('movie'),
        ], 201);
    }

    /**
     * Check if a specific movie is already in a device's watchList.
     * GET /api/watchList/check?device_id=xxxx&movie_id=1
     */
    public function check(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $exists = WatchList::where('device_id', $request->device_id)
            ->where('movie_id', $request->movie_id)
            ->exists();

        return response()->json([
            'isOk' => true,
            'inWatchList' => $exists,
        ], 200);
    }

    /**
     * Remove a movie from the watchList.
     * DELETE /api/watchList/{id}
     */
    public function destroy($id)
    {
        $watchList = WatchList::find($id);

        if (!$watchList) {
            return response()->json([
                'isOk' => false,
                'message' => 'WatchList item not found',
            ], 404);
        }

        $watchList->delete();

        return response()->json([
            'isOk' => true,
            'message' => 'Movie removed from watchList',
        ], 200);
    }

}