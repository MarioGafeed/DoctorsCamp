<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\LangApiMiddleware::class)->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login')->name('user.login');
    Route::post('login-social', 'SocialAuthController@login');
    Route::post('/password/email', 'AuthController@forgotPassword')->middleware('throttle:5,1')->name('password.email');
    Route::post('/verify/pin', 'AuthController@verifyPin')->middleware('throttle:5,1')->name('verify.pin');
    Route::post('/password/reset', 'AuthController@resetPassword')->name('apipassword.reset');
    // Contact Form
    Route::post('/contact', 'ContactFormController@contact')->name('guest.contact');

    // Countries
    Route::get('countries', 'CountryController@index');
    // FAQs
    Route::apiResource('faqs', 'FaqController')->only(['show', 'index']);
    // Categories
    Route::apiResource('categories', 'CategoryController')->only(['show', 'index']);
    // Posts
    Route::get('videos', 'PostsController@indexvideo');
    Route::apiResource('posts', 'PostsController')->only(['show', 'index']);
    Route::get('/post/{id}/comments', 'CommentController@postComments');
    // Comments
    Route::apiResource('comments', 'CommentController')->only(['index']);
    // Courses
    Route::apiResource('courses', 'CourseController');
    Route::get('courses/{course}/certificate', 'CourseCertificateController');

    // images
    Route::apiResource('images', 'ImagesController');


    Route::middleware('auth:sanctum')->group(function () {
        Route::get('notifications/{type?}', 'UsernotificationsController@index');
        Route::get('notification/mark-as-read/{id}', 'UsernotificationsController@read');
        Route::get('notification/mark-as-unread/{id}', 'UsernotificationsController@unread');
        // Notifications Test Api Tokens
        Route::post('token/update', 'UsernotificationsController@update');

        Route::get('me', 'AuthController@me');
        Route::get('showme', 'UserController@showme');
        Route::post('updateme', 'UserController@updateme');
        Route::get('verify', 'AuthController@verify');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('logout', 'AuthController@logout');
        Route::post('changePassword', 'AuthController@changePassword')->name('changePassword');
        Route::apiResource('posts', 'PostsController')->only(['store', 'update', 'destroy']);
        // Favorite
        Route::get('/userfavoritecategories', 'CategoryController@userfavoritecategories');
        Route::get('/userfavoriteposts', 'PostsController@userfavoriteposts');
        Route::get('/userfavoritecourses', 'CourseController@userfavoritecourses');
        Route::get('/userfavoriteimages', 'ImagesController@userfavoriteimages');

        // Route::apiResource('questions', 'QuestionController');
        Route::get('/myposts', 'PostsController@myposts')->name('posts.me');
        Route::post('/posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
        Route::delete('/posts/{post}/likes', 'PostLikeController@destroy')->name('posts.likes.destroy');
        // Route::apiResource('categories', 'CategoryController');
        Route::get('listcourseswithlikes', 'CourseController@indexcourseswithlikes');
        Route::get('courseuser/{course}', 'CourseController@showuser');
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
        Route::get('/userCoursesEnroll', 'CourseController@userCoursesEnroll')->name('user.courses.enroll');

        Route::get('/userquizzes', 'UserLessonController@userquizzes')->name('user.course.all');

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

        Route::post('/categories/likes', 'CategoryLikeController@store')->name('categories.likes.store');
        Route::delete('/categories/{category}/likes', 'CategoryLikeController@destroy')->name('categories.likes.destroy');

        Route::post('/images/{image}/likes', 'ImageLikeController@store')->name('images.likes.store');
        Route::delete('/images/{image}/likes', 'ImageLikeController@destroy')->name('images.likes.destroy');
    });
});
