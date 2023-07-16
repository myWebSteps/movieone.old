<?php

namespace App\Http\Resources\API\Movies;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nameRu' => $this->nameRu,
            'nameOriginal' => $this->nameOriginal,
            'year' => $this->year,
            'posterUrl' => url('/storage'.$this->poster_path),
        ];
    }
}
