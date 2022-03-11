<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(\App\Http\Middleware\LangMiddleware::class)->group(function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/lang/{lang}', [App\Http\Controllers\AdminController::class, 'changeLang'])->name('admin.changeLang');

    // users
    Route::resource('users', 'UsersController');
    Route::post('users/multi_delete', 'UsersController@multi_delete')->name('users.multi_delete');

    // roles and permissions
    Route::resource('roles', 'RoleController');
    Route::post('/roles/multi_delete', 'RoleController@multi_delete')->name('roles.multi_delete');

    Route::resource('permissions', 'PermissionController');
    Route::post('permissions/multi_delete', 'PermissionController@multi_delete')->name('permissions.multi_delete');

    // Comments
    Route::resource('comments', 'CommentController');
    Route::post('comments/multi_delete', 'CommentController@multi_delete')->name('comments.multi_delete');
    Route::get('/comments/toggle/{id}', 'CommentController@toggle')->name('comments.toggle');

    // Posts
    Route::resource('posts', 'PostController');
    Route::post('posts/multi_delete', 'PostController@multi_delete')->name('posts.multi_delete');

    // Events
    Route::resource('events', 'EventController');
    Route::post('events/multi_delete', 'EventController@multi_delete')->name('events.multi_delete');

    // Images
    Route::resource('images', 'ImageController');
    Route::post('images/multi_delete', 'ImageController@multi_delete')->name('images.multi_delete');

    //  Categories
    Route::resource('categories', 'CategoryController');
    Route::post('categories/multi_delete', 'CategoryController@multi_delete')->name('categories.multi_delete');

    // Messages
    Route::resource('messages', 'MessageController');
    Route::post('messages/multi_delete', 'MessageController@multi_delete')->name('messages.multi_delete');
    Route::post('messages/response', [App\Http\Controllers\MessageController::class, 'response'])->name('messages.response');;

    // Start E-learning

   // Courses
   Route::resource('courses', 'CourseController');
   Route::post('courses/multi_delete', 'CourseController@multi_delete')->name('courses.multi_delete');

   // Lessons
   Route::resource('lessons', 'LessonController');
   Route::post('lessons/multi_delete', 'LessonController@multi_delete')->name('lessons.multi_delete');

   // Questions
   Route::resource('questions', 'QuestionController');
   Route::post('questions/multi_delete', 'QuestionController@multi_delete')->name('questions.multi_delete');

   // Answers
   Route::resource('faqs', 'FaqController');
   Route::post('faqs/multi_delete', 'FaqController@multi_delete')->name('faqs.multi_delete');


});
