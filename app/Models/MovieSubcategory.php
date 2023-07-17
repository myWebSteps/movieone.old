<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movieSubcategory extends Model
{
    use HasFactory;

    protected $table = 'movie_subcategories';
    protected $guarded = false;

    public $timestamps = false;



}
