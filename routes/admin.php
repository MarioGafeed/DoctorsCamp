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

    // Posts
    Route::resource('posts', 'PostController');
    Route::post('posts/multi_delete', 'PostController@multi_delete')->name('posts.multi_delete');

    // Video Posts
    Route::resource('vposts', 'VpostController');
    Route::post('vposts/multi_delete', 'VpostController@multi_delete')->name('vposts.multi_delete');

    // Post taqs_
    Route::resource('ptaqs', 'PtaqController');
    Route::post('ptaqs/multi_delete', 'PtaqController@multi_delete')->name('ptaqs.multi_delete');

    // Video taqs_
    Route::resource('vtaqs', 'VtaqController');
    Route::post('vtaqs/multi_delete', 'VtaqController@multi_delete')->name('vtaqs.multi_delete');

    // Post Categories
    Route::resource('pcategories', 'PcategoryController');
    Route::post('pcategories/multi_delete', 'PcategoryController@multi_delete')->name('pcategories.multi_delete');

    // Video Post Categories
    Route::resource('vcategories', 'VcategoryController');
    Route::post('vcategories/multi_delete', 'VcategoryController@multi_delete')->name('vcategories.multi_delete');

    // Video Post Categories
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
   Route::resource('answers', 'AnswerController');
   Route::post('answers/multi_delete', 'AnswerController@multi_delete')->name('answers.multi_delete');


});
