<?php

namespace App\Services;

use App\Models\Movie;

class MovieService
{
    public function createMovie(array $data): Movie
    {
        return Movie::create($data);
    }

    public function updateMovie(Movie $movie, array $data): bool
    {
        return $movie->update($data);
    }

    public function deleteMovie(Movie $movie): ?bool
    {
        return $movie->delete();
    }
}
