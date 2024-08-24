<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Service\MovieService;
use function Carbon\this;


/**
 * Class MovieController
 * @package App\Http\Controllers
 */
class MovieController extends Controller
{
    /**
     * @var MovieService
     */
    protected $movieService;

    /**
     * MovieController constructor.
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMovieRequest $request
     * @return
     */
    public function store(StoreMovieRequest $request)
    {
        return $this->movieService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMovieRequest $request
     * @param Movie $movie
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        return $this->movieService->update($request,$movie);
    }

    /**
     * Remove the specified resource from storage.
     * @param Movie $movie
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
