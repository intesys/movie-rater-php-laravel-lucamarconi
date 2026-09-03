<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'release_year',
        'director',
        'cast',
        'genre',
        'plot',
    ];

    protected $casts = [
        'cast' => 'array',
        'release_year' => 'integer',
    ];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAlphabetical(Builder $query): Builder
    {
        return $query->orderBy('title', 'asc');
    }

    /**
     * @param Builder $query
     * @param int $years
     * @return Builder
     */
    public function scopeOlderThan(Builder $query, int $years): Builder
    {
        $target = now()->year - $years;

        return $query->where('release_year', '<', $target);
    }
}
