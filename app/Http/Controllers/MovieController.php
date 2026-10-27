<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    // display all movies
    public function index()
    {
        //
        $movie = Movie::all();

        return view("Movies.index", ["result" => $movie]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  
        return view("Movies.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $data = $request->validated();

        $poster = $data['poster'];
        $posterName = time() . '.' . $poster->extension();
        $poster->move(public_path('images/movies'), $posterName);
        $data['poster'] = $posterName;

        $Movie = Movie::create($data);

        return redirect("movies");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $Movie = Movie::findorfail($id);

        return view("Movies.show", ["Movie" => $Movie]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $Movie = Movie::find($id);

        return view("Movies.edit", ["Movie" => $Movie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMovieRequest $request, string $id)
    {
        $Movie = Movie::find($id);
        
        $data = $request->validated();

        if ($request->hasFile('poster')) {

            if (File::exists(public_path('images/movies/' . $Movie->poster))) {
                File::delete(public_path('images/movies/' . $Movie->poster));
            }

            $poster = $data['poster'];;
            $posterName = time() . '.' . $poster->extension();
            $poster->move(public_path('images/movies'), $posterName);
            $data['poster'] = $posterName;
        } else {
            $posterName = $Movie->poster;
            $data['poster'] = $posterName;
        }

        $Movie->update($data);

        return redirect("movies");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $Movie = Movie::findOrFail($id);

        $imagePath = public_path('images/movies/' . $Movie->poster);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $Movie->delete();

        return redirect("movies");
    }
}
