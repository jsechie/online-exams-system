<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('user.dashboard');
Route::get('/users/logout', 'Auth\LoginController@userlogout')->name('user.logout');
 // Route::get('/student/check-pwd', 'HomeController@ChkPassword');

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
    Route::get('/academics/status/{id}','admin\AcademicsController@status')->name('academics.status');
  	Route::resource('/users','admin\AdminCRUDcontroller');
    Route::resource('/questions','admin\QuestionsController');
    Route::get('/questions/add/{id}','admin\QuestionsController@createQuestion')->name('questions.add');
    Route::get('/questions/status/{id}','admin\QuestionsController@status')->name('questions.status');
    Route::get('/questions/activateAll/{id}','admin\QuestionsController@activateAll')->name('questions.activate');
    Route::get('/questions/deactivateAll/{id}','admin\QuestionsController@deactivateAll')->name('questions.deactivate');
    Route::get('/course/status/{id}','admin\CourseController@status')->name('course.status');
    Route::get('/course/assignUser/{id}','admin\CourseController@assign')->name('course.assign');
    Route::match(['put','patch'],'/course/assign/{id}','admin\CourseController@updateAssign')->name('assign.update');
    Route::post('/questions/upload','admin\QuestionsController@upload')->name('questions.upload');

    Route::resource('/examsSettings','admin\ExamsSettingsController');
    Route::get('/examsSettings/view/{id}','admin\ExamsSettingsController@view')->name('examsSettings.view');
    Route::get('/examsSettings/status/{id}','admin\ExamsSettingsController@status')->name('examsSettings.status');
    Route::delete('/examsSettings/remove/{id}','admin\ExamsSettingsController@removeQuestion')->name('examsSettings.remove');
    Route::match(['put','patch'],'/examsSettings/updateQuestion/{id}','admin\ExamsSettingsController@updateQuestion')->name('examsSettings.updateQuestion');
    Route::get('/examsSettings/addMoreQuestions/{id}','admin\ExamsSettingsController@moreQuestions')->name('examsSettings.moreQuestions');
     Route::match(['get','post'],'/examsSettings/addQuestions/{id}','admin\ExamsSettingsController@addQuestions')->name('examsSettings.addQuestions');

    // adminStudents Route
    Route::get('/allStudents','admin\AdminStudentController@allStudents')->name('allStudents');
    Route::get('/students/department/{id}','admin\AdminStudentController@depStudents')->name('department.students');
    Route::match(['get','post'],'/students/year/{id}','admin\AdminStudentController@yearStudents')->name('year.students');
    Route::get('/myStudents','admin\AdminStudentController@myStudents')->name('myStudents');
     Route::match(['get','post'],'/myStudents/course','admin\AdminStudentController@myStudentsCourse')->name('myStudentsCourse');

});

//students route groups
  Route::prefix('students')->group(function(){
    Route::get('/settings', 'HomeController@settings')->name('user.settings');
    Route::match(['get','post'],'/update-pwd','HomeController@updatePassword');
    Route::get('/courses', 'student\CourseController@index')->name('student.course');
    Route::match(['get','post'],'/profile/{id}','HomeController@profile')->name('student.profile');

  });