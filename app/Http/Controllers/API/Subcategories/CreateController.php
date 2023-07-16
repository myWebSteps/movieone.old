<?php

namespace App\Http\Controllers\API\Subcategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Subcategories\CreateRequest;
use App\Models\SubCategory;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $data = $request->validated();

        return SubCategory::create($data);
    }
}
