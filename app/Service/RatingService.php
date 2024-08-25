<?php

namespace App\Service;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingService
{
    public function getAll()
    {
        return Rating::all();
    }

    public function store(StoreRatingRequest $request, $movieId)
    {
        $validated = $request->validated();
        $userId = Auth::id();
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
        return response()->json(['message' => 'Rating added successfully']);
    }

    public function showById(Rating $rating)
    {
        return $rating->get();
    }

    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validated = $request->validated();
        $rating->update($validated);
        return response()->json([
            'success' => 'Rating updated successfully'
        ]);
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response()->json([
            'success' => 'Rating deleted successfully'
        ]);
    }

    public function showRatingByUser()
    {
        $user = Auth::user();
        $rating = $user->ratings;
        return $rating;
    }

    public function showRatingByMovie($movieId)
    {

        $movie= Movie::find($movieId);
        $ratings = $movie->ratings;
        return response()->json([
            'Total Rating : ' => $movie->averageRating(),
            'ratings : ' => $ratings
        ]);
    }
}
