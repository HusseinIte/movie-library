<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Carbon\this;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'description'
    ];

    public function scopeByGenre(Builder $query, $genre)
    {
        $query->where('genre', $genre);
    }


    public function scopeByDirector(Builder $query, $director)
    {
        $query->where('director', $director);
    }

    public function scopeSortByRelease(Builder $query, $sortOrder)
    {
        $query->orderBy('release_year', $sortOrder);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // calculate general rating for movie by average of users rating
    public function averageRating()
    {
        return $this->ratings->avg('rating');
    }

}

