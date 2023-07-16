<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Home\IndexResourse;
use App\Models\Category;
use App\Models\Movie;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class IndexController extends Controller
{
    public function __invoke()
    {
        $result = [];

        $categories = Category::all();

        foreach($categories as $key => $item)
        {
            $result[$key]['category'] = $item;
            $result[$key]['movies'] = Movie::where('category_id', $item->id)->select('id', 'nameRu', 'nameOriginal', 'poster_path', 'year')->orderBy('id', 'desc')->take(4)->get();
        }

        return IndexResourse::collection($result);

    }
}
