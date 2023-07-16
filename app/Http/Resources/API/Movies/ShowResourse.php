<?php

namespace App\Http\Resources\API\Movies;

use App\Models\Country;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResourse extends JsonResource
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
             $subcategories[] = SubCategory::where('id', $subcategory->subcategory_id)->first();
        }
        $countries = [];
        foreach ($this->countries as $country) {
            $countries[] = Country::where('id', $country->country_id)->first();
        }


        $posterUrl = url('storage' . $this->poster_path);



        return [
            'id' => $this->id,
            'kinopoisk_id' => $this->kinopoisk_id,
            'posterUrl' => $posterUrl,
            'nameRu' => $this->nameRu,
            'nameOriginal' => $this->nameOriginal,
            'category' => $this->category_id,
            'subcategories' => $subcategories,
            'type' => $this->type,
            'slogan' => $this->slogan,
            'description' => $this->description,
            'filmLength' => $this->duration,
            'endYear' => $this->year,
            'rate' => $this->rate,
            'countries' => $countries

        ];
    }
}
