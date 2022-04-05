<?php

use Illuminate\Support\Facades\Route;

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('login-social', 'SocialAuthController@login');
Route::post('/password/email', 'AuthController@sendPasswordResetLinkEmail')->middleware('throttle:5,1')->name('password.email');
Route::post('/password/reset', 'AuthController@resetPassword')->name('password.reset');


// FAQs
Route::apiResource('faqs', 'FaqController')->only(['show', 'index']);
// Categories
Route::apiResource('categories', 'CategoryController')->only(['show', 'index']);
// Posts
Route::apiResource('posts', 'PostsController')->only(['show', 'index']);
// Comments
Route::apiResource('comments', 'CommentController')->only(['index']);
// Courses
Route::apiResource('courses', 'CourseController');
// images
Route::apiResource('images', 'ImagesController');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', 'AuthController@me');
    Route::get('verify', 'AuthController@verify');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('logout', 'AuthController@logout');
    Route::post('changePassword', 'AuthController@changePassword')->name('changePassword');
    Route::apiResource('posts', 'PostsController')->only(['store', 'update', 'destroy']);
    Route::post('/posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
    Route::delete('/posts/{post}/likes', 'PostLikeController@destroy')->name('posts.likes.destroy');
    // Route::apiResource('categories', 'CategoryController');
    // Route::apiResource('questions', 'QuestionController');
    Route::post('/posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
    Route::delete('/posts/{post}/likes', 'PostLikeController@destroy')->name('posts.likes.destroy');
    // Route::apiResource('categories', 'CategoryController');
    Route::apiResource('lessons', 'LessonController');
    Route::apiResource('questions', 'QuestionController');
    Route::get('lesson/showquestion/{id}', 'LessonController@showQuestion');
    Route::post('lesson/startquiz/{id}', 'LessonController@startQuiz');
    Route::post('lesson/submitquiz/{lesson}', 'LessonController@submitQuiz');

    Route::post('/courses/{course}/likes', 'CourseLikeController@store')->name('courses.likes.store');
    Route::delete('/courses/{course}/likes', 'CourseLikeController@destroy')->name('courses.likes.destroy');

    Route::post('/events/{event}/likes', 'EventLikeController@store')->name('events.likes.store');
    Route::delete('/events/{event}/likes', 'EventLikeController@destroy')->name('events.likes.destroy');
    Route::apiResource('events', 'EventController');
    Route::apiResource('comments', 'CommentController')->only('store', 'update', 'destroy');
    // Route::apiResource('categories', 'CategoryController');
    Route::post('/posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
    Route::delete('/posts/{post}/likes', 'PostLikeController@destroy')->name('posts.likes.destroy');
    // Route::apiResource('categories', 'CategoryController');
    Route::post('/images/{image}/likes', 'ImageLikeController@store')->name('images.likes.store');
    Route::delete('/images/{image}/likes', 'ImageLikeController@destroy')->name('images.likes.destroy');
});
