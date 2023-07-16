<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Category $category)
    {
        $category->delete();
    }
}
