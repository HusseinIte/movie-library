<?php

namespace App\Service;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingService
{
    public function index()
    {
        return Rating::all();
    }

    public function store(StoreRatingRequest $request, $movieId)
    {
        $validated = $request->validated();
        Rating::create([
            'user_id' => Auth::id(),
            'movie_id' => $movieId,
            'rating' => $validated['rating'],
            'review' => isset($validated['review']) ? $validated['review'] : null
        ]);
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
}
