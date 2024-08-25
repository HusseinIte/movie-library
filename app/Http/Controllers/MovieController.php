<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Service\MovieService;
use Illuminate\Http\Request;
use function Carbon\this;
/*
 * this controller responsible for crud function Movies
 * create - update - delete - read - readByID => Movie
 */

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
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return $this->movieService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMovieRequest $request
     * @return \App\Http\Resources\MovieResource
     */
    public function store(StoreMovieRequest $request)
    {
        return $this->movieService->store($request);
    }

    /**
     * Display the specified resource.
     * @param Movie $movie
     * @return \App\Http\Resources\MovieResource
     */
    public function show(Movie $movie)
    {
        return $this->movieService->show($movie);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMovieRequest $request
     * @param Movie $movie
     * @return \App\Http\Resources\MovieResource
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        return $this->movieService->update($request,$movie);
    }

    /**
     * Remove the specified resource from storage.
     * @param Movie $movie
     * @return mixed
     */
    public function destroy(Movie $movie)
    {
        return $this->movieService->destroy($movie);
    }
}
