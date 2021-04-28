<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Quiz\QuizController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('home1', function () {
    return view('staff/Home');
});

Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::group(['prefix'=>'Registration'],function(){


    Route::get('login','User\UserController@login')->name('login');
    //Route::get('signup','User\UserController@signup')->name('signup');

});

Route::group(['middleware' => 'loggedin'],function (){
    Route::view('course','staff/course');
    //Route::get('/courseView/{courseID}','Course\CourseController@showCourse');
    Route::get('home','Teach\TeachController@getTeachedCourses')->name('home');
    Route::get('getEnrolledCourses','Teach\TeachController@getTeachedCourses')->name('getEnrolledCourses');
});

Route::post('createAccount','User\userRegistration@signUp')->name("createAccount");
Route::post('validate','User\userRegistration@login')->name('validate');
Route::post('createSession','Session\SessionController@createSession')->name('create_session');
Route::view('course','staff/course');
Route::view('signup','Registration.SignUp')->name('signup');
Route::view('login','Registration.Login')->name('login');
//validate quiz part
Route::post('saveQuiz','Quiz\QuizController@createQuiz')->name('saveQuiz');
Route::post('saveQuestion','Quiz\QuizController@createQuiz')->name('saveQuestion');
Route::post('saveQuestion','Question\QuestionController@createQuestion')->name('saveQuestion');
//quiz part
Route::view('createQuiz','Quiz.createQuiz')->name('createQuiz');
Route::view('addQuestion','Quiz.addQuestion')->name('addQuestion');
Route::view('addAnswer','Quiz.addAnswer')->name('addAnswer');

Route::get('/courseView/{courseID}',[CourseController::class,'showCourse']);
Route::view('QrCode','staff/QrCode')->name('QrCode');
Route::view('createSession','staff.createSession')->name('createSession');
//Course\CourseController@showCourse
//test
Route::get('getCourses/{studentID}',[CourseController::class,'getEnrolledCourses']);
Route::get('getSessions/{courseID}',[SessionController::class,'getSessionsOfCourse']);
Route::get('getAttendance/{sessionID}',[AttendanceController::class,'getAttendanceOfSession']);
Route::get('getNumOfAbsents/{courseID}',[AttendanceController::class,'getNumOfAbsencesInCourse']);
Route::get('deleteQuiz/{CourseID}',[QuizController::class,'deleteQuiz']);
//AttendanceController
//logout
Route::get('/flush', function () {
    Session::flush();
    return redirect()->route('login');
})->name('flush');




