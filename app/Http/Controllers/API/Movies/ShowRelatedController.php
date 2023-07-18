<?php

namespace App\Http\Controllers\API\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\API\Movies\FilterIndexResource;
use App\Http\Resources\API\Movies\IndexResourse;
use App\Http\Resources\API\Movies\ShowRelatedResource;
use App\Http\Resources\API\Movies\ShowResourse;
use App\Models\CountryMovie;
use App\Models\Movie;
use App\Models\movieSubcategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShowRelatedController extends Controller
{
    public function __invoke(Request $request)
    {

        $data = SubCategory::where('id', $request->subcatId)->first();

        $result = $data->movies->whereNotIn('id', $request->movieId)->shuffle()->take(4);


        return ShowRelatedResource::collection($result);
    }
}
