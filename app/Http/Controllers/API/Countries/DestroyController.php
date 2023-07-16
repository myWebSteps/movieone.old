<?php

namespace App\Http\Controllers\API\Countries;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Country $country)
    {
        $country->delete();
    }
}
