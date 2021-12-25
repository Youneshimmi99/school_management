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

// Auth::routes();
//admin   

Route::get('/login/admin', 'AuthController@IndexLoginAdmin')->name("loginadmin");
Route::post('/loginadmin', 'AuthController@LoginAdmin');




Route::middleware(['admin'])->group(function () {
    Route::get('/administration', 'AuthController@IndexDashboardAdmin');
    include('classe.php');
    Route::post('/logout', 'AuthController@LougoutAdmin');
    Route::post('/add/prof', 'AuthController@AddProf');
    Route::get('/subjects', 'AuthController@GetSubjects');
    Route::get('/subjectsprof', 'AuthController@GetSubjectsProf');
    Route::get('/cycles', 'AuthController@GetCycles');
    Route::get('/grades/{id}', 'AuthController@GetGrades');
    Route::get('/getclasses/{id}','AdminController@GetClasses');
    Route::get('/getclassesbyid/{id}','AdminController@GetClassesByIdGrade');
    Route::get('/branches/{id}','AdminController@GetBranchs');
    Route::post('/class/add', 'AdminController@AddClasse');
    Route::post('/add/admin', 'AdminController@AddAdmin');
    Route::get('/teachers','AdminController@Allteachers');
    Route::get('/teachers/edit/{id}','AdminController@IditTeacher');
    Route::post('/teachers/update','AdminController@UpdateTeacher');
    Route::post('/delete/teacher/{id}','AdminController@DeleteTeacher');






});





