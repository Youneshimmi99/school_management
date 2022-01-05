<?php
Route::get('course', 'CourseController@index')->name('course.index'); 
Route::get('course/archive', 'CourseController@archive')->name('course.archive'); 
Route::get('course/{course}', 'CourseController@show')->name('course.show');
Route::post('course', 'CourseController@store')->name('course.store');
Route::put('course/{course}', 'CourseController@update')->name('course.update');
Route::post('course/{course}/restore', 'CourseController@restore')->name('course.restore'); 
Route::delete('course/{course}/trash', 'CourseController@trash')->name('course.trash');
Route::delete('course/{course}/destroy', 'CourseController@destroy')->name('course.destroy');
Route::get('teacherCourses/{teacher_id}', 'CourseController@teacherCourses')->name('course.teacherCourses'); 
Route::get('subjectCourses/{subject_id}', 'CourseController@subjectCourses')->name('course.subjectCourses'); 
