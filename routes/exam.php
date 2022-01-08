<?php
Route::get('exam', 'ExamController@index')->name('exam.index'); 
Route::get('exam/archive', 'ExamController@archive')->name('exam.archive'); 
Route::get('exam/{course}', 'ExamController@show')->name('exam.show');
Route::post('exam', 'ExamController@store')->name('exam.store');
Route::put('exam/{exam}', 'ExamController@update')->name('exam.update');
Route::post('exam/{exam}/restore', 'ExamController@restore')->name('exam.restore'); 
Route::post('exam/{exam}/trash', 'ExamController@trash')->name('exam.trash');
Route::post('exam/{exam}/destroy', 'ExamController@destroy')->name('exam.destroy');
Route::get('teacherExams/{teacher_id}', 'ExamController@teacherExams')->name('course.teacherExams'); 
Route::get('subjectExams/{subject_id}', 'ExamController@subjectExams')->name('course.subjectExams');


