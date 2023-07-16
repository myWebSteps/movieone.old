<?php

namespace App\Http\Resources\API\Admin\Movies;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResourse extends JsonResource
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
            'kinopoisk_id' => $this->kinopoisk_id,
            'year' => $this->year,
            'nameRu' => $this->nameRu,
            'nameOriginal' => $this->nameOriginal
        ];
    }
}
