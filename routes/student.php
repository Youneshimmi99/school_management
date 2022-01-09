<?php

Route::get('student_classe/{student_id}', 'StudentController@studentClasse')->name('student.studentClasse');
Route::get('student_timetable/{student_id}', 'StudentController@studentTimetable')->name('student.studentTimetable');
Route::get('student_teachers_absences/{student_id}', 'StudentController@studentTeachersAbsences')->name('student.studentTeachersAbsences');







Route::post('course', 'CourseController@store')->name('course.store');
Route::post('course/{course}', 'CourseController@update')->name('course.update');
Route::post('course/{course}/restore', 'CourseController@restore')->name('course.restore'); 
Route::post('course/{course}/trash', 'CourseController@trash')->name('course.trash');
Route::post('course/{course}/destroy', 'CourseController@destroy')->name('course.destroy');
Route::get('teacherCourses/{teacher_id}', 'CourseController@teacherCourses')->name('course.teacherCourses'); 
Route::get('subjectCourses/{subject_id}', 'CourseController@subjectCourses')->name('course.subjectCourses'); 

Route::get('course/title/{title}', 'CourseController@RechercheCoure');