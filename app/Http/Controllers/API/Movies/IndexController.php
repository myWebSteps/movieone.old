<?php

namespace App\Http\Controllers\API\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Resources\API\Movies\FilterIndexResource;
use App\Http\Resources\API\Movies\IndexResourse;
use App\Models\Movie;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        $filter = app()->make(MovieFilter::class, ['queryParams' => array_filter($data)]);

        $movies = Movie::filter($filter)->orderBy($request->get('order'), 'desc')->paginate(20, ['*'], 'page', $request->get('page'));

        return IndexResourse::collection($movies);
    }
}
