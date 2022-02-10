<?php

use Illuminate\Support\Facades\Route;

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('/password/email', 'AuthController@sendPasswordResetLinkEmail')->middleware('throttle:5,1')->name('password.email');
Route::post('/password/reset', 'AuthController@resetPassword')->name('password.reset');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', 'AuthController@me');
    Route::get('verify', 'AuthController@verify');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('logout', 'AuthController@logout');
    Route::apiResource('posts', 'PostsController');
  
  
    Route::apiResource('images', 'ImagesController');
  
    Route::post('/posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
    Route::delete('/posts/{post}/likes', 'PostLikeController@destroy')->name('posts.likes.destroy');
  
  
    Route::apiResource('categories', 'CategoryController');    


    Route::post('/images/{image}/likes', 'ImageLikeController@store')->name('images.likes.store');
    Route::delete('/images/{image}/likes', 'ImageLikeController@destroy')->name('images.likes.destroy');
});
