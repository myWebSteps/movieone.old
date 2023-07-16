<?php

namespace App\Http\Controllers\API\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\Admin\Movies\StoreRequest;
use App\Http\Resources\API\Admin\Movies\IndexResourse;
use App\Models\CountryMovie;
use App\Models\Movie;
use App\Models\movieSubcategory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class IndexController extends Controller
{
    public function __invoke()
    {
       $data = Movie::all();

       return IndexResourse::collection($data);
    }
}
