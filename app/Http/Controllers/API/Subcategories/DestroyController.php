<?php

namespace App\Http\Controllers\API\Subcategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(SubCategory $subcategory)
    {
        $subcategory->delete();
    }
}
