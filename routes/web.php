<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;



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
    return view('layout');
});
//Route::view('register','register');
//Route::view('login','login');

Route::group(['middleware'=>'customAuth'],function(){
    //Route::get('/list','RestoController@list');
   // Route::view('/add','add');
    //Route::post('addResto','RestoController@addResto');
    Route::view('register','register');
    Route::view('login','login');
   Route::get('logout','App\Http\Controllers\userLogin@logout');
    
    });

    Route::post('registerUser','App\Http\Controllers\userLogin@registerUser');
    Route::post('loginUser','App\Http\Controllers\userLogin@loginUser');

    
