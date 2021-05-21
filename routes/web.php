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
Route::get('home', function () {
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
Route::get('getData','K_Means\KmeansController@readData');
Route::get('update','Grade\GradeController@update');
Route::get('generate','Grade\GradeController@generateAttendanceData');
Route::post('createSession','Session\SessionController@createSession')->name('create_session');
Route::post('get_session','Session\SessionController@getSessionsOfCourse')->name('get_sessions');
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
Route::get('/showQuizes/{courseID}','quiz\QuizController@showQuizes')->name('showQuizes');
Route::get('/showQuiz/{quizID}','quiz\QuizController@showQuiz')->name('showQuiz');
Route::view('createquiz','staff/quiz')->name('createquiz');
Route::post('savequiz','quiz\QuizController@createQuiz')->name('savequiz');


Route::view('sessions','staff.sessions')->name('sessions');
Route::view('newSession','staff.createNewSession')->name('newSession');

Route::get('/courseView/{courseID}',[CourseController::class,'showCourse']);
Route::view('QrCode','staff/QrCode')->name('QrCode');
Route::view('createSession','staff.createSession')->name('createSession');

Route::view('courses','staff.Courses')->name('courses');
Route::view('create_course','staff.createCourse')->name('create_course');
Route::post('addCourse','Course\CourseController@createCourse')->name('addCourse');
Route::view('join_course','staff/joinCourse')->name('join_course');
Route::post('joinCourse','Course\CourseController@joinCourse')->name('joinCourse');
Route::post('delete_course','Course\CourseController@deleteCourse')->name('delete_course');
Route::post('delete_instructor_course','Teach\TeachController@deleteInstructorCourse')->name('delete_instructor_course');
//Course\CourseController@showCourse
//test
Route::get('getCourses/{studentID}',[CourseController::class,'getEnrolledCourses']);
Route::get('getSessions/{courseID}',[SessionController::class,'getSessionsOfCourse']);
Route::get('getAttendance}',[AttendanceController::class,'getAttendanceOfSession'])->name('getAttendance');
Route::get('getNumOfAbsents/{courseID}',[AttendanceController::class,'getNumOfAbsencesInCourse']);
Route::get('deleteQuiz/{CourseID}',[QuizController::class,'deleteQuiz']);
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
Route::get('removeQuestion','quiz\QuestionController@destroy')->name('removeQuestion');




