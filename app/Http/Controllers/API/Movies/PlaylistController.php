<?php

namespace App\Http\Controllers\API\Movies;

use App\Http\Controllers\Controller;
use App\Http\Filters\MovieFilter;
use App\Http\Requests\API\Movies\PlaylistRequest;
use App\Http\Resources\API\Movies\FilterIndexResource;
use App\Http\Resources\API\Movies\IndexResourse;
use App\Http\Resources\API\Movies\PlaylistResource;
use App\Models\Movie;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function __invoke(PlaylistRequest $request)
    {
        $data = $request->validated();

        $ids = explode(',', $data['id']);

        $result = Movie::whereIn('id', $ids)->get();

        return PlaylistResource::collection($result);
    }
}
