<?php

namespace App\Http\Resources\API\Movies;

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
        $subcategories = [];
        foreach ($this->subcategories as $subcategory) {
             $subcategories[] = SubCategory::where('id', $subcategory->subcategory_id)->first('title');
        }

        $posterUrl = url('storage' . $this->poster_path);


        return [
            'id' => $this->id,
            'kinopoisk_id' => $this->kinopoisk_id,
            'nameRu' => $this->nameRu,
            'nameOriginal' => $this->nameOriginal,
            'posterUrl' => $posterUrl,
            'subcategory_title' => $subcategories,
            'year' => $this->year,
        ];
    }
}
