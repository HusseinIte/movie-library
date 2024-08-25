<?php

namespace App\Service;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieService
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Movie::query();
        if ($request->filled('genre')) {
            $query->byGenre($request->input('genre'));
        }
        if ($request->filled('director')) {
            $query->byDirector($request->input('director'));
        }
        if ($request->filled('sort_order')) {
            $query->sortByRelease($request->input('sort_order'));
        }
        $moviesPerPage = $request->get('perPage', 10);
        $movies = $query->paginate($moviesPerPage);

        return  MovieResource::collection($movies);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();
        Movie::create($validated);
        return response()->json([
            'success' => 'movie has created'
        ]);

    }

    /**
     * Display the specified resource.
     * @param Movie $movie
     * @return
     */
    public function show(Movie $movie)
    {

        return response()->json([
            'success' => 'movie has retrieve',
            'movie' => new MovieResource($movie)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();
        $movie->update($validated);
        return response()->json([
            'success' => 'movie ' . $movie->title . 'updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json([
            'success' => 'movie ' . $movie->title . ' has been deleted'
        ]);
    }
}
