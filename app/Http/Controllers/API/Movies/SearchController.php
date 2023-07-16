<?php

namespace App\Http\Controllers\API\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\API\Movies\FilterIndexResource;
use App\Http\Resources\API\Movies\IndexResourse;
use App\Models\Movie;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();



//        return IndexResourse::collection($movies);
    }
}
