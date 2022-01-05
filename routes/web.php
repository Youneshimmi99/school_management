<?php

use Illuminate\Support\Facades\Route;




include('grade.php');  
Route::get('/login/admin', 'AuthController@IndexLoginAdmin')->name("loginadmin");
Route::post('/loginadmin', 'AuthController@LoginAdmin');


 

Route::middleware(['admin'])->group(function () {
include('teacher.php'); 
    Route::get('/administration', 'AuthController@IndexDashboardAdmin');
    // include('classe.php');
    Route::get('classe/archive', 'ClasseController@archive')->name('classe.archive'); 
// Route::resource('classe', 'ClasseController',['except'=>['destroy']]);
    Route::post('classe/delete/{id}', 'ClasseController@TrashStudent');
    Route::post('classe/destroy/{id}', 'ClasseController@destroy');
    Route::post('classe/restore/{id}', 'ClasseController@Restore');
    include('timetable.php');
    include('teacher_absences.php');
    Route::post('/logout', 'AuthController@LougoutAdmin');
    Route::post('/add/prof', 'AuthController@AddProf');
    Route::post('/add/classes/teacher', 'AuthController@AddTeacherClasses');
    Route::get('/subjectsprof', 'AuthController@GetSubjectsProf');
    Route::get('/getclasses/{id}','AdminController@GetClasses');
    Route::get('/getclassesbyid/{id}','AdminController@GetClassesByIdGrade');
    Route::get('/getclassesbyid/notimeTable/{id}','AdminController@ClasseTimeTableOk');
    Route::get('/adminactive','AdminController@GestAdminActive');
    Route::post('/class/add', 'AdminController@AddClasse');
    Route::post('/add/admin', 'AdminController@AddAdmin');
    Route::get('/teachers','AdminController@Allteachers');
    Route::get('teachers/emploidone','AdminController@ConfirmTimeTable');
    Route::get('/teachers/notimetable','AdminController@AllteachersNotTimetable');
    Route::get('/teachers/classes','AdminController@AllteachersClasses');
    Route::get('/classes_teachers/{id}','AdminController@ClassesTeacher');
    Route::get('/teachers/edit/{id}','AdminController@EditTeacher');
    Route::get('/admin/edit/{id}','AdminController@EditAdmin');
    Route::post('/teachers/update','AdminController@UpdateTeacher');
    Route::post('/admin/update','AdminController@UpdateAdmin');
    Route::post('/delete/teacher/{id}','AdminController@DeleteTeacher');
    Route::post('/delete/teacher/classe/{id}','AdminController@DelteTeacherClasse');
    Route::post('/delete/emploi/{id}','AdminController@DeleteTimeTable');
    Route::post('/addstudent','AdminController@AddStudent');
    Route::get('/students','AdminController@AllStudents');
    Route::get('/get/admins','AdminController@AllAdmins');
    Route::get('/student/edit/{id}','AdminController@editStudent');
    Route::post('/student/update','AdminController@UpdateStudent');
    Route::post('/delete/student/{id}','AdminController@DeleteStudent');
    Route::post('/delete/admin/{id}','AdminController@DeleteAdmin');
    Route::get('/admin/edit/{id}','AdminController@EditAdmin');
    Route::post('/admin/update','AdminController@UpdateAdmin');
    Route::post('/delete/admin/{id}','AdminController@DeleteAdmin');
});
//admin and prof
Route::get('/cycles', 'AuthController@GetCycles');
Route::get('/grades/{id}', 'AuthController@GetGrades');
Route::get('/subjects', 'AuthController@GetSubjects');
Route::get('/branches/{id}','AdminController@GetBranchs');

 Route::get('/login/prof','AuthController@IndexTeacherLogin');
 Route::post('/loginteacher','AuthController@LoginTeacher');

Route::middleware(['teacher'])->group(function () {
    include('course.php'); 
    include('exercice.php'); 
    include('exam.php');

    Route::get('/getclassesbyprof/{id}','Teacher2Controller@GetClassesProf');
    Route::get('/accueil','Teacher2Controller@IndexDashTeacher');
    Route::post('/logoutteacher', 'AuthController@LogoutTeacher');
});
 
 




