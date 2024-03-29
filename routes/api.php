<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//return $request->user();

//});

Route::post('signup','User\UserControllerApi@save_data');
Route::post('login','User\UserControllerApi@validate_login');

Route::post('attend_lec','ApiAttendance\AttendanceController@attendLecture');
Route::post('createCourse','Course\CourseController@createCourse');
Route::post('joinCourse','Course\CourseController@joinCourse');
Route::post('quizCorrection','quiz\QuizController@quizCorrection');


