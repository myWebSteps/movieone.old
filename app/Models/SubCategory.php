<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $guarded = false;

    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_subcategories', 'subcategory_id', 'movie_id');
    }
}
