<?php

namespace App\Http\Controllers\API\Subcategories;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Subcategories\IndexResourse;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $category = $request->get('category');

        $subCategories = SubCategory::where('category_id', $category)->get();

        return IndexResourse::collection($subCategories);
    }
}
