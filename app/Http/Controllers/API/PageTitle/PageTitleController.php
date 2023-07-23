<?php

namespace App\Http\Controllers\API\PageTitle;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Categories\IndexResourse;
use App\Models\Category;
use Illuminate\Http\Request;

class PageTitleController extends Controller
{
    public function __invoke(Request $request)
    {

        $category = Category::find($request->category);

        return $category;
    }
}
