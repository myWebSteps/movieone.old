<?php

namespace App\Http\Controllers\API\Admin\Movies;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\Admin\Movies\StoreRequest;
use App\Models\CountryMovie;
use App\Models\Movie;
use App\Models\movieSubcategory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $files = $data['files'];
        unset($data['files']);
        $countries = explode(',',$data['countries']);
        unset($data['countries']);
        $subcategories = explode(',',$data['subcategories']);
        unset ($data['subcategory_id']);

        forEach($files as $file)
           {
            Image::make($file)
                ->fit(684, 1000)
                ->save(storage_path('/app/public/files'.'/poster'.$data['kinopoisk_id'].'.'.$file->getClientOriginalExtension()));
           }

            $poster_path = '/files'.'/poster'.$data['kinopoisk_id'].'.'.$file->getClientOriginalExtension();

            $movie = Movie::firstOrCreate(
                ['kinopoisk_id' => $data['kinopoisk_id']],
                [
                    'kinopoisk_id' => $data['kinopoisk_id'],
                    'nameRu' => $data['nameRu'],
                    'nameOriginal' => $data['nameOriginal'],
                    'poster_path' => $poster_path,
                    'type' => $data['type'],
                    'category_id' => $data['category_id'],
                    'year' => $data['year'],
                    'duration' => $data['duration'],
                    'rate' => $data['rate'],
                    'slogan' => $data['slogan'],
                    'description' => $data['description'],
                    ]
                );

        $movie->createSubcategories()->attach($subcategories);
        $movie->createCountries()->attach($countries);

    }
}
