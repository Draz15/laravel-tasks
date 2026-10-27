<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\MovieResource;
use App\Http\Requests\StoreMovieRequest as RequestsStoreMovieRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\File;

class ApiMovieController extends Controller
{
    //

    // send all movies available

    public function index()
    {

        $movies = Movie::all();
        return response()->json([
            "isOk" => true,
            "status" => 200,
            "data" => MovieResource::collection($movies),
            "message" => "data fetched Successfully",
            "error" => false,
        ], 200);
    }

    // add new movie

    public function store(RequestsStoreMovieRequest $request)
    {
        $movie = $request->validated();

        $image = $request->file('poster');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $movie['poster'] = $imageName;


        $movieResponse = Movie::create($movie);

        return  response()->json([
            "message" => "created successfully",
            'data' => new MovieResource($movieResponse)
        ], 201);
    }


    // send specific movie based on id


    public function show(string $id)
    {

        $movie = Movie::find($id);
        if (!$movie) {

            return response()->json([
                "isOk" => false,
                "status" => 404,
                "data" => null,
                "message" => "can not fetch data",
                "error" => true,
            ], 404);
        }

        return response()->json([
            "isOk" => true,
            "status" => 200,
            "data" => new MovieResource($movie),
            "message" => "data fetched Successfully",
            "error" => false,
        ], 200);
    }

    // update specific movie based on id

    public function update(RequestsStoreMovieRequest $request, string $id)
    {
        $movie = Movie::findOrFail($id);
        $updatedMovie = $request->validated();


        if ($request->hasFile("poster")) {
            if (File::exists(public_path('images/movies/' . $movie->poster))) {
                File::delete(public_path('images/movies/' . $movie->poster));
            }

            $image = $updatedMovie->file('poster');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/movies'), $imageName);
            $movie->poster = $imageName;
        } else {
            $imageName = $movie->poster;
        }


        $movie->update($updatedMovie);

        return  response()->json([
            "message" => "updated successfully",
            'data' => new MovieResource($movie)
        ], 201);
    }



    // delete specific movie based on id

    public function destroy(string $id)
    {

        $movie = Movie::find($id);

        if (!$movie) {

            return response()->json([
                "isOk" => false,
                "status" => 404,
                "data" => null,
                "message" => "can not delete it",
                "error" => true,
            ], 404);
        }

        $movie->delete();
        return response()->json([
            "isOk" => true,
            "status" => 200,
            "message" => "deleted Successfully",
            "error" => false,
        ], 200);
    }
}
