<?php

namespace App\Http\Resources\API\Home;

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
        foreach ($this['movies'] as $movie) {
            $movie['subcategories'] = $movie->createSubcategories;
            $movie['poster_path'] = url('/storage'.$movie['poster_path']);
        }

        return [
            'category' => $this['category'],
            'movies' => $this['movies'],
        ];
    }
}
