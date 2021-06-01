<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Attendance\AttendanceController;

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

//Route::get("createquiz","quiz\QuizController@quizCorrection");

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', function () {
    return view('staff/Home');
});

Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::group(['prefix'=>'Registeration'],function(){


    Route::get('login','User\UserController@login')->name('login');
    //Route::get('signup','User\UserController@signup')->name('signup');

});

Route::group(['middleware' => 'loggedin'],function (){
    Route::view('course','staff/course');
    //Route::get('/courseView/{courseID}','Course\CourseController@showCourse');
    Route::get('home','Teach\TeachController@getEnrolledCourses')->name('home');
    Route::get('getEnrolledCourses','Teach\TeachController@getEnrolledCourses')->name('getEnrolledCourses');
});

Route::post('createAccount','User\userRegisteration@signUp')->name("createAccount");
Route::post('validate','User\userRegisteration@login')->name('validate');
Route::post('createSession','Session\SessionController@createSession')->name('create_session');
Route::view('course','staff/course');
Route::view('signup','Registeration.SignUp')->name('signup');
Route::view('login','Registeration.Login')->name('login');
Route::get('/courseView/{courseID}',[CourseController::class,'showCourse']);
Route::view('QrCode','staff/QrCode')->name('QrCode');
Route::view('createSession','staff.createSession')->name('createSession');
//Route::get();
Route::get('/showQuizes/{courseID}','quiz\QuizController@showQuizes')->name('showQuizes');
Route::get('/showQuiz/{quizID}','quiz\QuizController@showQuize')->name('showQuize');
//Course\CourseController@showCourse
//test
Route::get('getCourses/{studentID}',[CourseController::class,'getEnrolledCourses']);
Route::get('getSessions/{courseID}',[SessionController::class,'getSessionsOfCourse']);
Route::get('getAttendance/{sessionID}',[AttendanceController::class,'getAttendanceOfSession']);
//AttendanceController
//logout
Route::get('/flush', function () {
    Session::flush();
    return redirect()->route('login');
})->name('flush');

Route::view('/createquiz/{courseID}','staff/quiz');
Route::get('createQuiz/{courseID}',function ($courseID){
    return view('staff/quiz')->with('courseID',$courseID);
})->name('createQuiz');
Route::post('savequiz','quiz\QuizController@createQuiz')->name('savequiz');
Route::post('saveNewQuestions','quiz\QuestionController@saveQuestions')->name('saveNewQuestions');

Route::post('removeQuestion','quiz\QuestionController@destroy')->name('removeQuestion');
Route::post('removeChoice','quiz\QuestionController@removeChoice')->name('removeChoice');
Route::post('addOption','quiz\QuestionController@addOption')->name('addOption');

Route::post('updatequestion', 'quiz\QuestionController@update')->name('updateQuestion');

Route::get('getData','K_Means\KmeansController@kMeansquiz');

Route::get('Data','Naeve\NaeveController@naeve');
