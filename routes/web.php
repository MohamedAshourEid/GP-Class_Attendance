<?php

use Illuminate\Support\Facades\Route;

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
    return view('staff/Home');
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
    Route::get('home','User\Course@getEnrolledCourses')->name('home');
    Route::get('getEnrolledCourses','Teach\TeachController@getEnrolledCourses')->name('getEnrolledCourses');
});

Route::post('createAccount','User\userRegisteration@signUp')->name("createAccount");
Route::post('validate','User\userRegisteration@login')->name('validate');
Route::post('createSession','Session\SessionController@createSession')->name('create_session');
Route::view('course','staff/course');
Route::view('signup','Registeration.SignUp')->name('signup');
Route::view('login','Registeration.Login')->name('login');
Route::get('/courseView/{courseID}','Course\CourseController@showCourse');
Route::view('QrCode','staff/QrCode')->name('QrCode');

});





