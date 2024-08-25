<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Service\RatingService;
use function Carbon\this;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return $this->ratingService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request, $movieId)
    {
        return $this->ratingService->store($request, $movieId);
    }

    /**
     * Display the specified resource.
     */
    public function showById(Rating $rating)
    {
        return $this->ratingService->showById($rating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        return $this->ratingService->update($request, $rating);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        return $this->ratingService->destroy($rating);
    }

    public function showRatingByUser()
    {
        return $this->ratingService->showRatingByUser();
    }

    public function showRatingByMovie($movieId)
    {
        return $this->ratingService->showRatingByMovie($movieId);
    }
}
