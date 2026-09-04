<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Usiamo questa classe MovieResource per definire cosa esporre via api. Utile per disaccoppiarlo dal model eloquent
 */
class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // Non è richiesta la restituzione dell'id
            // 'id' => $this->id,
            'title' => $this->title,
            'release_year' => $this->release_year,
            'director' => $this->director,
            'genre' => $this->genre,
            // Il cast viene convertito automaticamente in array JSON
            'cast' => $this->cast,
            'plot' => $this->plot,
        ];
    }
}
