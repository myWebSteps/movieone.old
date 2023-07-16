<?php

namespace App\Http\Controllers\API\Countries;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Categories\IndexResourse;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $countries = Country::all();

        return IndexResourse::collection($countries);
    }
}
