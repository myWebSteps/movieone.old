<?php

namespace App\Http\Controllers\API\Subcategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Subcategories\UpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, SubCategory $subcategory)
    {
        $data = $request->validated();

        $subcategory->update($data);
    }
}
