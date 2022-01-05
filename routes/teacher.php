<?php


Route::get('allStudents', 'TeacherController@allStudents')->name('teacher.allStudents');
Route::get('maleStudents', 'TeacherController@maleStudents')->name('teacher.maleStudents');
Route::get('femaleStudents', 'TeacherController@femaleStudents')->name('teacher.femaleStudents');
Route::get('allClasses', 'TeacherController@allClasses')->name('teacher.allClasses');
Route::get('gradesClasses', 'TeacherController@gradesClasses')->name('teacher.gradesClasses');
Route::get('allTeachers', 'TeacherController@allTeachers')->name('teacher.allTeachers');
Route::get('subjectsTeachers', 'TeacherController@subjectsTeachers')->name('teacher.subjectsTeachers');

