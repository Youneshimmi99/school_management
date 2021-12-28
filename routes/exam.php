<?php
Route::get('exam', 'ExamController@index')->name('exam.index'); 
Route::get('exam/archive', 'ExamController@archive')->name('exam.archive'); 
Route::get('exam/{course}', 'ExamController@show')->name('exam.show');
Route::post('exam', 'ExamController@store')->name('exam.store');
Route::put('exam/{exam}', 'ExamController@update')->name('exam.update');
Route::post('exam/{exam}/restore', 'ExamController@restore')->name('exam.restore'); 
Route::delete('exam/{exam}/trash', 'ExamController@trash')->name('exam.trash');
Route::delete('exam/{exam}/destroy', 'ExamController@destroy')->name('exam.destroy');
