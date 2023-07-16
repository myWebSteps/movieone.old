<?php

namespace App\Http\Controllers\API\Countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Countries\UpdateRequest;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Country $country)
    {
        $data = $request->validated();

        $country->update($data);
    }
}
