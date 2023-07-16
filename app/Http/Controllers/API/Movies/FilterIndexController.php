<?php

namespace App\Http\Controllers\API\Movies;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Movies\FilterIndexResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FilterIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $subcategories = $request->get('category');

        $subcategories = SubCategory::where('category_id', $subcategories)->get();

        return FilterIndexResource::collection($subcategories);
    }
}
