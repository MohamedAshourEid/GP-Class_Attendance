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
    return view('welcome');
});

Route::get('home', function () {
    return view('staff/Home');
});

Route::group(['namespace'=>'Admin'],function (){
    Route::get('first', 'AdminController@showString')->middleware('auth');
});

Route::get('index','Admin\AdminController@showIndex');

Route::resource('news' , 'NewsController');//create controller that have all crud operations

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('getOffers','CrudController@getOffers');

Route::group(['prefix'=>'Registeration'],function(){
    Route::get('signup','User\UserController@signup')->name('signup');

    Route::get('login','User\UserController@login')->name('login');

    Route::post('store','User\UserController@save_data')->name('store');


});

Route::group(['middleware' => 'loggedin'],function (){
//    Route::view('course','staff/course');
    Route::get('/courseView/{courseID}','User\Course@showCourse');
    Route::get('home','User\Course@getEnrolledCourses')->name('home');
});

Route::post('newLec','QrCode\QrCodeController@generateQrCode');
Route::post('createAccount','User\UserRegistration@signUp')->name("createAccount");
Route::post('validate','User\UserRegistration@login')->name('validate');

Route::view('signup','Registeration.SignUp');





