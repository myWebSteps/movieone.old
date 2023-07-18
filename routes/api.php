<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user', \App\Http\Controllers\UserController::class);



 Route::middleware('admin')->group(function (){


     Route::prefix('movies')->group(function(){
         Route::get('/index', \App\Http\Controllers\API\Admin\Movies\IndexController::class);
         Route::post('/store', \App\Http\Controllers\API\Admin\Movies\StoreController::class);
         Route::post('/update/{movie}', \App\Http\Controllers\API\Admin\Movies\UpdateController::class);
         Route::delete('/destroy/{movie}', \App\Http\Controllers\API\Admin\Movies\DestroyController::class);
         Route::post('/test_in_bd', \App\Http\Controllers\API\Admin\Movies\TestInBdController::class);
     });


     Route::prefix('categories')->group(function (){
         Route::post('/create_category', \App\Http\Controllers\API\Categories\CreateController::class);
         Route::patch('/update/{category}', \App\Http\Controllers\API\Categories\UpdateController::class);
         Route::delete('/destroy/{category}', \App\Http\Controllers\API\Categories\DestroyController::class);
     });

     Route::prefix('countries')->group(function (){
         Route::post('/create_country', \App\Http\Controllers\API\Countries\CreateController::class);
         Route::patch('/update/{country}', \App\Http\Controllers\API\Countries\UpdateController::class);
         Route::delete('/destroy/{country}', \App\Http\Controllers\API\Countries\DestroyController::class);
     });

     Route::prefix('subcategories')->group(function (){
         Route::patch('/update/{subcategory}', \App\Http\Controllers\API\Subcategories\UpdateController::class);
         Route::delete('/destroy/{subcategory}', \App\Http\Controllers\API\Subcategories\DestroyController::class);
         Route::post('/create', \App\Http\Controllers\API\Subcategories\CreateController::class);

     });

 });
});



Route::get('/home', \App\Http\Controllers\API\Home\IndexController::class);
Route::get('/categories', \App\Http\Controllers\API\Categories\IndexController::class);
Route::get('/', \App\Http\Controllers\API\Movies\FilterIndexController::class);
Route::get('/filterindex', \App\Http\Controllers\API\Movies\FilterIndexController::class);
Route::get('/countries', \App\Http\Controllers\API\Countries\IndexController::class);
Route::get('/movies', \App\Http\Controllers\API\Movies\IndexController::class);
Route::get('/subcategories', \App\Http\Controllers\API\Subcategories\IndexController::class);
Route::get('/movie/{id}', \App\Http\Controllers\API\Movies\ShowController::class);
Route::get('/movie/get_related/{subcatId}/{movieId}', \App\Http\Controllers\API\Movies\ShowRelatedController::class);
Route::post('/playlist', \App\Http\Controllers\API\Movies\PlaylistController::class);


// Admin Routes

