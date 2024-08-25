<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Service\RatingService;
use Illuminate\Http\Request;
use function Carbon\this;
/*
 *  this controller responsible for Rating Crud and some services :
 * services -show rating for user using auth
 *          -show rating for movie (total rating - rating for user)
 */

/**
 * Class RatingController
 * @package App\Http\Controllers
 */
class RatingController extends Controller
{
    /**
     * @var RatingService
     */
    protected $ratingService;

    /**
     * RatingController constructor.
     * @param RatingService $ratingService
     */
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
     * @param StoreRatingRequest $request
     * @param int id
     * @return mixed
     */
    public function store(StoreRatingRequest $request, $movieId)
    {
        return $this->ratingService->store($request, $movieId);
    }

    /**
     * Display the specified resource.
     * @param Rating $rating
     * @return mixed
     */
    public function showById(Rating $rating)
    {
        return $this->ratingService->showById($rating);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRatingRequest $request
     * @param Rating $rating
     * @return mixed
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        return $this->ratingService->update($request, $rating);
    }

    /**
     * Remove the specified resource from storage.
     * @param Rating $rating
     *
     * @return mixed
     */
    public function destroy(Rating $rating)
    {
        return $this->ratingService->destroy($rating);
    }

    /**
     * @return Rating
     */
    public function showRatingByUser()
    {
        return $this->ratingService->showRatingByUser();
    }

    /**
     * @param $movieId
     * @return mixed
     */
    public function showRatingByMovie($movieId)
    {
        return $this->ratingService->showRatingByMovie($movieId);
    }
}
