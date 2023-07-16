<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Categories\CreateRequest;
use App\Http\Requests\API\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $data = $request->validated();

        return Category::create($data);
    }
}
