<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('user.dashboard');
Route::get('/users/logout', 'Auth\LoginController@userlogout')->name('user.logout');
Route::get('/student/settings', 'HomeController@settings')->name('user.settings');
 // Route::get('/student/check-pwd', 'HomeController@ChkPassword');
Route::match(['get','post'],'/student/update-pwd','HomeController@updatePassword');

Route::prefix('admin')->group(function(){
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
  Route::get('/settings','AdminController@settings')->name('admin.settings');
  Route::match(['get','post'],'/update-pwd','AdminController@updatePassword');
  Route::match(['get','post'],'/profile/{id}','AdminController@profile')->name('admin.profile');

	  // test routes
  	Route::resource('/department','admin\DepartmentController');
  	Route::resource('/role','admin\RoleController');
  	Route::resource('/course','admin\CourseController');
  	Route::resource('/academics','admin\AcademicsController');
  	Route::resource('/users','admin\AdminCRUDcontroller');
    Route::resource('/questions','admin\QuestionsController');
    Route::get('/questions/add/{id}','admin\QuestionsController@createQuestion')->name('questions.add');
    Route::get('/questions/status/{id}','admin\QuestionsController@status')->name('questions.status');
    Route::get('/course/status/{id}','admin\CourseController@status')->name('course.status');
});

