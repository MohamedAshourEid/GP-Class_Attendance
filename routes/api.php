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

Route::get('doctors',function (){
    $doctors=[['name'=>'osama esmail',
        'id'=>'20070145',
        'email'=>'osama145@gmail.com'],
        ['name'=>'galal eldien',
        'id'=>'200150120',
        'email'=>'galal145@gmail.com']
    ];
    return $doctors;
});
