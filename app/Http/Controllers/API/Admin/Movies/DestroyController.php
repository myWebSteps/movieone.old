<?php

namespace App\Http\Controllers\API\Admin\Movies;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DestroyController extends Controller
{
    public function __invoke(Movie $movie)
    {

        $fileToDelete = $movie->getAttribute('poster_path');

        File::delete(storage_path('/app/public' . $fileToDelete));

        $movie->delete();
    }
}
