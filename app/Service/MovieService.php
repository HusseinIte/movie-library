<?php

namespace App\Service;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

/**
 * Class MovieService
 * @package App\Service
 */
class MovieService
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection ::collection
     */
    public function index(Request $request)
    {
        $query = Movie::query();
//        filter depend on query parameter
        if ($request->filled('genre')) {
            // use scope in movie model
            $query->byGenre($request->input('genre'));
        }
        if ($request->filled('director')) {
            // use scope in movie model
            $query->byDirector($request->input('director'));
        }
        if ($request->filled('sort_order')) {
            // use scope in movie model
            $query->sortByRelease($request->input('sort_order'));
        }
        $moviesPerPage = $request->get('perPage', 10);
        $movies = $query->paginate($moviesPerPage);

        return MovieResource::collection($movies);

    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMovieRequest $request
     * @return MovieResource
     */
    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();
        Movie::create($validated);
        return response()->json([
            'success' => 'movie has created'
        ], 201);

    }

    /**
     * Display the specified resource.
     * @param Movie $movie
     * @return MovieResource
     */
    public function show(Movie $movie)
    {

        return response()->json([
            'success' => 'movie has retrieve',
            'movie' => new MovieResource($movie)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMovieRequest $request
     * @param Movie $movie
     * @return MovieResource
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();
        $movie->update($validated);
        return response()->json([
            'success' => 'movie ' . $movie->title . 'updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Movie $movie
     * @return mixed
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json([
            'success' => 'movie ' . $movie->title . ' has been deleted'
        ], 200);
    }
}
