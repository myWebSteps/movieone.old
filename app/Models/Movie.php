<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use Filterable;

    protected $table ='movies';
    protected $guarded = false;

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function subcategories()
    {
        return $this->hasMany(movieSubcategory::class);
    }

    public function countries()
    {
        return $this->hasMany(CountryMovie::class);
    }


    public function createSubcategories()
    {
        return $this->belongsToMany( SubCategory::class, movieSubcategory::class, 'movie_id', 'subcategory_id');
    }

    public function createCountries()
    {
        return $this->belongsToMany(Country::class, CountryMovie::class);
    }






}
