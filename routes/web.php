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

include('grade.php');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
//admin   
Route::get('/login/admin', 'AuthController@IndexLoginAdmin');
Route::get('/administration', 'AuthController@IndexDashboardAdmin');
Route::post('/loginadmin', 'AuthController@LoginAdmin');



