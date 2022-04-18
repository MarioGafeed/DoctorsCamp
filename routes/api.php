<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\LangApiMiddleware::class)->group(function () {

  Route::post('register', 'AuthController@register');
  Route::post('login', 'AuthController@login')->name('user.login');
  Route::post('login-social', 'SocialAuthController@login');
  Route::post('/password/email', 'AuthController@sendPasswordResetLinkEmail')->middleware('throttle:5,1')->name('password.email');
  Route::post('/password/reset', 'AuthController@resetPassword')->name('password.reset');


  // Countries
  Route::get('countries', 'CountryController@index');
  // FAQs
  Route::apiResource('faqs', 'FaqController')->only(['show', 'index']);
  // Categories
  Route::apiResource('categories', 'CategoryController')->only(['show', 'index']);
  // Posts
  Route::apiResource('posts', 'PostsController')->only(['show', 'index']);
  Route::get('/post/{id}/comments', 'CommentController@postComments');
  // Comments
  Route::apiResource('comments', 'CommentController')->only(['index']);
  // Courses
  Route::apiResource('courses', 'CourseController');
  // images
  Route::apiResource('images', 'ImagesController');

  Route::middleware('auth:sanctum')->group(function () {

      Route::get('notifications/{type?}', 'UsernotificationsController@index');
      Route::get('notification/show/{id}', 'UsernotificationsController@show');
      Route::get('notification/mark-as-read/{id}', 'UsernotificationsController@read');
      Route::get('notification/mark-as-unread/{id}', 'UsernotificationsController@unread');

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
      Route::get('lesson/{id}/showquestions', 'QuestionController@showLessonQuestions');
      // Route::get('lesson/showquestion/{id}', 'LessonController@showQuestion');

      Route::post('lesson/startquiz/{id}', 'LessonController@startQuiz');
      Route::post('lesson/submitquiz/{lesson}', 'LessonController@submitQuiz');

      Route::post('/courses/{course}/likes', 'CourseLikeController@store')->name('courses.likes.store');
      Route::delete('/courses/{course}/likes', 'CourseLikeController@destroy')->name('courses.likes.destroy');
      Route::post('/courses/{course}/enroll', 'CourseController@enroll')->name('user.course.enroll');
      Route::get('/usercompletecourses', 'CourseController@usercompletecourses')->name('user.course.list');
      Route::get('/useruncompletecourses', 'CourseController@useruncompletecourses')->name('user.course.list');
      Route::get('/userallcourses', 'CourseController@userallcourses')->name('user.course.all');

      Route::get('/courses/{course}/lessons', 'LessonController@courseUserLessons')->name('user.course.lessons');

      Route::post('/events/{event}/likes', 'EventLikeController@store')->name('events.likes.store');
      Route::delete('/events/{event}/likes', 'EventLikeController@destroy')->name('events.likes.destroy');
      Route::apiResource('events', 'EventController');
      Route::post('events/enroll/{id}', 'EventController@enroll')->name('user.events.enroll');
      Route::post('events/disenroll/{id}', 'EventController@disenroll')->name('user.events.disenroll');
      Route::get('userevents', 'EventController@userList')->name('user.events.list');
      Route::apiResource('comments', 'CommentController')->only('store', 'update', 'destroy');
      // Route::apiResource('categories', 'CategoryController');
      Route::post('/posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
      Route::delete('/posts/{post}/likes', 'PostLikeController@destroy')->name('posts.likes.destroy');

      // Route::apiResource('categories', 'CategoryController');
      Route::post('/images/{image}/likes', 'ImageLikeController@store')->name('images.likes.store');
      Route::delete('/images/{image}/likes', 'ImageLikeController@destroy')->name('images.likes.destroy');
  });


});
