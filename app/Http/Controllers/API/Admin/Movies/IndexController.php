<?php

namespace App\Http\Controllers\API\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\Admin\Movies\StoreRequest;
use App\Http\Resources\API\Admin\Movies\IndexResourse;
use App\Models\CountryMovie;
use App\Models\Movie;
use App\Models\movieSubcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class IndexController extends Controller
{
    public function __invoke()
    {
       $data = DB::table('movies')->orderBy('id', 'desc')->get();

       return IndexResourse::collection($data);
    }
}
