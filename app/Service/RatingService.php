<?php

namespace App\Service;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

/**
 * Class RatingService
 * @package App\Service
 */
class RatingService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Rating::all();
    }

    /**
     * @param StoreRatingRequest $request
     * @param $movieId
     * @return mixed
     */
    public function store(StoreRatingRequest $request, $movieId)
    {
        $validated = $request->validated();
        $userId = Auth::id();
// Prevent multiple ratings for the same movie.
        $existingRating = Rating::where('movie_id', $movieId)
            ->where('user_id', $userId)
            ->first();

        if ($existingRating) {

            $existingRating->rating = $validated['rating'];
            $existingRating->save();
        } else {
            Rating::create([
                'user_id' => $userId,
                'movie_id' => $movieId,
                'rating' => $validated['rating'],
                'review' => isset($validated['review']) ? $validated['review'] : null
            ]);
        }
        return response()->json(['message' => 'Rating added successfully'], 201);
    }

    /**
     * @param Rating $rating
     * @return mixed
     */
    public function showById(Rating $rating)
    {
        return $rating->get();
    }

    /**
     * @param UpdateRatingRequest $request
     * @param Rating $rating
     * @return mixed
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validated = $request->validated();
        $rating->update($validated);
        return response()->json([
            'success' => 'Rating updated successfully'
        ], 200);
    }

    /**
     * @param Rating $rating
     * @return mixed
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response()->json([
            'success' => 'Rating deleted successfully'
        ], 200);
    }

    /**
     * @return Rating
     */
    public function showRatingByUser()
    {
        $user = Auth::user();
        $rating = $user->ratings;
        return $rating;
    }

    /**
     * @param $movieId
     * @return mixed
     */
    public function showRatingByMovie($movieId)
    {

        $movie = Movie::find($movieId);
        $ratings = $movie->ratings;
        return response()->json([
            'Total Rating : ' => $movie->averageRating(),
            'ratings : ' => $ratings
        ], 200);
    }
}
