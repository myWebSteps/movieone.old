<?php

namespace App\Http\Controllers\API\Countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Countries\CreateRequest;
use App\Http\Requests\API\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $data = $request->validated();

        return Country::firstOrCreate(['title' => $data['title']], $data);
    }
}
