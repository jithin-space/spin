<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/about', 'AboutController@index');
Route::get('/search','SearchController@index');
Route::get('find', 'SearchController@find');

Route::model('students','\App\Student');

Route::group(['prefix'=> 'admin'], function(){
  Route::resource('/users','UserController');
  Route::resource('students','StudentController');
  Route::resource('/assign', 'AssignController');
  Route::resource('roles', 'RoleController');
  Route::resource('roles.subrole','SubRoleController');
  Route::resource('/tags','TagController');

  Route::resource('/search', 'SearchController');

  Route::resource('/permissions', 'PermissionController');
  Route::get('students/{student}/iep/active', 'StudentIEPController@showActive')->name('students.iep.active');
  Route::resource('students.iep','StudentIEPController');
  Route::resource('students.feedback','StudentFeedbackController');
  Route::resource('students.attendance','StudentAttendanceController');
  Route::resource('students.general_info','StudentGinfoController');
  Route::resource('students.background_info','StudentBinfoController');
  Route::resource('students.guardian_info','StudentGuardianInfoController');
  Route::resource('students.school_info','StudentSinfoController');
  Route::resource('students.status_report','StatusReportController');
  Route::resource('students.med_info','StudentMedInfoController');
  Route::resource('students.strength_info','StrengthInfoController');
  Route::resource('students.other_services','OtherServicesController');
  Route::resource('students.media_gallery','MediaGalleryController');
  Route::resource('students.iep.comment','StudentIEPCommentController');
  Route::resource('students.feedback.comment','StudentFeedbackCommentController');
});
Route::group(['prefix'=> 'user'], function(){
  Route::resource('/profile','ProfileController');
  });
Route::group(['prefix'=> 'teacher'], function(){
    Route::resource('users','UserController');
    Route::resource('students','StudentController');
    Route::resource('roles', 'RoleController');
    Route::resource('roles.subrole','SubRoleController');
    Route::resource('permissions', 'PermissionController');
    Route::get('students/{student}/iep/active', 'StudentIEPController@showActive')->name('students.iep.active');
    Route::resource('students.iep','StudentIEPController');
    Route::resource('students.feedback','StudentFeedbackController');
    Route::resource('students.iep.comment','StudentIEPCommentController');
    Route::resource('students.feedback.comment','StudentFeedbackCommentController');
    Route::resource('students.attendance','StudentAttendanceController');
  });
  Route::group(['prefix'=>'{\Auth::user()->roles()->first()->name}'],function(){
    Route::resource('users','UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('roles.subrole','SubRoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('students','StudentController');
    Route::get('students/{student}/iep/active', 'StudentIEPController@showActive')->name('students.iep.active');
    Route::resource('students.iep','StudentIEPController');
    Route::resource('students.feedback.comment','StudentFeedbackCommentController');
    Route::resource('students.iep.comment','StudentIEPCommentController');
    Route::resource('students.feedback','StudentFeedbackController');
    Route::resource('students.attendance','StudentAttendanceController');
  });

Route::group(['prefix'=> 'extras'], function(){
      Route::resource('/vocabulary','VocabularyController');
      Route::resource('/terms','TermController');
    });
