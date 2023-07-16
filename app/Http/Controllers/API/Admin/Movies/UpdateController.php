<?php

namespace App\Http\Controllers\API\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\Admin\Movies\StoreRequest;
use App\Http\Requests\API\Admin\Movies\UpdateRequest;
use App\Models\CountryMovie;
use App\Models\Movie;
use App\Models\movieSubcategory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Movie $movie)
    {
        $data = $request->validated();

        if(isset($data['files'])){
            $files = $data['files'];
            unset($data['files']);

            forEach($files as $file)
            {
                Image::make($file)
                    ->fit(684, 1000)
                    ->save(storage_path('/app/public/files'.'/poster'.$data['kinopoisk_id'].'.'.$file->getClientOriginalExtension()));
            }

            $poster_path = '/files'.'/poster'.$data['kinopoisk_id'].'.'.$file->getClientOriginalExtension();
            $data['poster_path'] = $poster_path;
        }


        $countries = explode(',',$data['countries']);
        unset($data['countries']);
        $subcategories = explode(',',$data['subcategories']);
        unset ($data['subcategories']);

        $movie->update(
                $data
                );

        $movie->createSubcategories()->sync($subcategories);
        $movie->createCountries()->sync($countries);

    }
}
