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
    /*$data=[ ];
    $data['id']=20170166;
    $data['name']='alaa ebrahim';
    $data['age']=21;*/
    return view('welcome');
});
//another way to send data in route to view
//Route::get('/', function () {
//$data=[];
//    $data['id']=20170166;
//    $data['name']='alaa ebrahim';
// $data['age']=21;
//return view('welcome',$data);
//});

Route::group(['namespace'=>'Admin'],function (){
    Route::get('first', 'AdminController@showString')->middleware('auth');
});

Route::get('index','Admin\AdminController@showIndex');

//Route::get('first', 'Admin\AdminController@showString');
//Route::get('users', 'Admin\AdminController@showString')->middleware('auth');

/*Route::group(['middleware'=> 'auth'],function(){
    Route::get('users', 'Admin\AdminController@showString');
});*/

Route::resource('news' , 'NewsController');//create controller that have all crud operations



Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('getOffers','CrudController@getOffers');

Route::group(['prefix'=>'offers'],function (){
    //Route::get('store','CrudController@store');
    Route::get('create','CrudController@create');
    Route::post('store','CrudController@store')->name('offers.store');
});

Route::group(['prefix'=>'Registeration'],function(){
    Route::get('signup','User\UserController@signup')->name('signup');

    Route::get('login','User\UserController@login')->name('login');

    Route::post('store','User\UserController@save_data')->name('store');

    Route::post('validate','User\UserController@validate_login')->name('validate');
});

Route::post('newLec','QrCode\QrCodeController@generateQrCode');
Route::view('course','staff/course');


