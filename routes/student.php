<?php

Route::get('/student/classe', 'StudentController@studentClasse')->name('student.studentClasse');
Route::get('/student_timetable/student', 'StudentController@studentTimetable')->name('student.studentTimetable');
Route::get('/student/teachers/absences', 'StudentController@studentTeachersAbsences')->name('student.studentTeachersAbsences');

Route::get('/get/cycle', 'StudentController@getNameCycle');

Route::get('/StudentSubjectExams/{subject_id}', 'StudentController@getStudentSubjectExams');
Route::get('/StudentSubjectCourses/{subject_id}', 'StudentController@getStudentSubjectCourses');
Route::get('/CoursExercices/{cours_id}', 'StudentController@getCoursExercices');








// Route::post('course', 'CourseController@store')->name('course.store');
// Route::post('course/{course}', 'CourseController@update')->name('course.update');
// Route::post('course/{course}/restore', 'CourseController@restore')->name('course.restore'); 
// Route::post('course/{course}/trash', 'CourseController@trash')->name('course.trash');
// Route::post('course/{course}/destroy', 'CourseController@destroy')->name('course.destroy');
// Route::get('teacherCourses/{teacher_id}', 'CourseController@teacherCourses')->name('course.teacherCourses'); 
// Route::get('subjectCourses/{subject_id}', 'CourseController@subjectCourses')->name('course.subjectCourses'); 

// Route::get('course/title/{title}', 'CourseController@RechercheCoure');