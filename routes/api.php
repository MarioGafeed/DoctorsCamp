<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\LangApiMiddleware::class)->group(function () {


  // if (\Request::header('Authorization')){
  //   Route::middleware('auth:sanctum')->group(function () {
  //     Route::apiResource('images', 'ImagesController');
  //   });
  // }

    $middleware = ['api'];
      if (\Request::header('Authorization')){
        $middleware = array_merge(['auth:sanctum']);
        Route::group(['middleware' => $middleware], function () {
          Route::apiResource('images', 'ImagesController');
          Route::apiResource('posts', 'PostsController')->only(['show', 'index']);
          Route::get('videos', 'PostsController@indexvideo');
          Route::get('sounds', 'PostsController@indexsound');
          // Contact Form
          Route::post('/contact', 'ContactFormController@contact')->name('guest.contact');
          Route::apiResource('faqs', 'FaqController')->only(['show', 'index']);
          // Categories Courses
          Route::get('categories/courses', 'CategoryController@indexCourses');
          // Comments
          Route::apiResource('comments', 'CommentController')->only(['index']);
          Route::get('/post/{id}/comments', 'CommentController@postComments');
          // images
          Route::apiResource('images', 'ImagesController');
          Route::get('categories/images', 'CategoryController@indexImages');
          Route::get('categories/articles', 'CategoryController@index');
          Route::get('categories/videos', 'CategoryController@indexVideos');
          Route::get('categories/sounds', 'CategoryController@indexSounds');

          Route::apiResource('categories', 'CategoryController')->only('index', 'show');

          Route::get('categories/{category}/showvideo', 'CategoryController@showVideo');
          Route::get('categories/{category}/showcourse', 'CategoryController@showCourse');
          Route::get('categories/{category}/showsound', 'CategoryController@showSound');
          Route::get('categories/{category}/showimage', 'CategoryController@showImage');
          Route::apiResource('courses', 'CourseController');
          Route::get('courses/{course}/certificate', 'CourseCertificateController');
          // EventS
          Route::apiResource('events', 'EventController');

        });
  }else {
    Route::get('agreement', 'AuthController@agreement')->name('agreement.show');
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
    // Categories Courses
    Route::get('categories/courses', 'CategoryController@indexCourses');
    // Posts
    Route::get('videos', 'PostsController@indexvideo');
    Route::get('sounds', 'PostsController@indexsound');
    Route::get('/post/{id}/comments', 'CommentController@postComments');
    Route::apiResource('posts', 'PostsController')->only(['show', 'index']);
    // Comments
    Route::apiResource('comments', 'CommentController')->only(['index']);
    // Courses
    Route::apiResource('courses', 'CourseController');
    // Route::get('courses/{course}/certificate', 'CourseCertificateController');

    // images
    Route::apiResource('images', 'ImagesController');
    Route::get('categories/images', 'CategoryController@indexImages');

    Route::get('categories/articles', 'CategoryController@index');
    Route::get('categories/videos', 'CategoryController@indexVideos');
    Route::get('categories/sounds', 'CategoryController@indexSounds');
    // Route::get('categories', 'CategoryController@index');
    Route::apiResource('categories', 'CategoryController')->only('index', 'show');
    Route::get('categories/{category}/showvideo', 'CategoryController@showVideo');
    Route::get('categories/{category}/showcourse', 'CategoryController@showCourse');
    Route::get('categories/{category}/showsound', 'CategoryController@showSound');
    Route::get('categories/{category}/showimage', 'CategoryController@showImage');
    // EventS
    Route::apiResource('events', 'EventController')

    ;
  }


    Route::middleware('auth:sanctum')->group(function () {

        Route::get('notifications/{type?}', 'UsernotificationsController@index');
        Route::get('notification/mark-as-read/{id}', 'UsernotificationsController@read');
        Route::get('notification/mark-as-unread/{id}', 'UsernotificationsController@unread');
        // Notifications Test Api Tokens
        Route::post('token/update', 'UsernotificationsController@update');
        Route::post('send-notification', 'UsernotificationsController@send');


        Route::get('me', 'AuthController@me');
        Route::get('showme', 'UserController@showme');
        Route::post('updateme', 'UserController@updateme');
        Route::get('verify', 'AuthController@verify');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('logout', 'AuthController@logout');
        Route::post('changePassword', 'AuthController@changePassword')->name('changePassword');
        Route::apiResource('posts', 'PostsController')->only(['store', 'update']);
        Route::get('post/user', 'PostsController@index');
        Route::post('posts/del/{post}', 'PostsController@destroy');
        // Favorite
        Route::get('/userfavoritecategories', 'CategoryController@userfavoritecategories');
        Route::get('/userfavoriteposts', 'PostsController@userfavoriteposts');
        Route::get('/userfavoritevideos', 'PostsController@userfavoritevideos');
        Route::get('/userfavoritesounds', 'PostsController@userfavoritesounds');
        Route::get('/userfavoritecourses', 'CourseController@userfavoritecourses');
        Route::get('/userfavoriteimages', 'ImagesController@userfavoriteimages');

        // Route::apiResource('questions', 'QuestionController');
        Route::get('/myposts', 'PostsController@myposts')->name('posts.me');
        Route::post('/posts/{post}/likeaction', 'PostLikeController@action')->name('posts.likes.action');
        // Route::apiResource('categories', 'CategoryController');
        Route::get('listcourseswithlikes', 'CourseController@indexcourseswithlikes');
        Route::get('courseuser/{course}', 'CourseController@showuser');
        Route::apiResource('lessons', 'LessonController');
        Route::apiResource('questions', 'QuestionController');
        Route::get('lesson/{id}/showquestions', 'QuestionController@showLessonQuestions');
        // Route::get('lesson/showquestion/{id}', 'LessonController@showQuestion');

        Route::post('lesson/startquiz/{id}', 'LessonController@startQuiz');
        Route::post('lesson/submitquiz/{lesson}', 'LessonController@submitQuiz');

        Route::post('/courses/{course}/likeaction', 'CourseLikeController@action')->name('courses.likes.action');
        Route::post('/courses/{course}/enroll', 'CourseController@enroll')->name('user.course.enroll');
        Route::get('/usercompletecourses', 'CourseController@usercompletecourses')->name('user.course.list');
        Route::get('/useruncompletecourses', 'CourseController@useruncompletecourses')->name('user.course.list');
        Route::get('/userallcourses', 'CourseController@userallcourses')->name('user.course.all');
        Route::get('/userCoursesEnroll', 'CourseController@userCoursesEnroll')->name('user.courses.enroll');

        Route::get('/userquizzes', 'UserLessonController@userquizzes')->name('user.course.all');

        Route::get('/courses/{course}/lessons', 'LessonController@courseUserLessons')->name('user.course.lessons');

        Route::post('/events/{event}/likeaction', 'EventLikeController@action')->name('events.likes.action');
        // Route::apiResource('events', 'EventController');
        Route::post('events/enroll/{id}', 'EventController@enroll')->name('user.events.enroll');
        Route::post('events/disenroll/{id}', 'EventController@disenroll')->name('user.events.disenroll');
        Route::get('userevents', 'EventController@userList')->name('user.events.list');
        Route::apiResource('comments', 'CommentController')->only('store', 'update');
        Route::post('comment/del/{comment}', 'CommentController@destroy');


        Route::post('/categories/likes', 'CategoryLikeController@store')->name('categories.likes.store');
        Route::post('/categories/{category}/del/likes', 'CategoryLikeController@destroy')->name('categories.likes.destroy');

        Route::post('/images/{image}/likeaction', 'ImageLikeController@action')->name('images.likes.action');


    });
});
