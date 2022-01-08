<?php
Route::get('exercice', 'ExerciceController@index')->name('exercice.index'); 
Route::get('/course/exercices/{courseExercices}', 'ExerciceController@courseExercices')->name('exercice.courseExercices'); 
Route::get('exercice/archive', 'ExerciceController@archive')->name('exercice.archive'); 
Route::get('exercice/{exercice}', 'ExerciceController@show')->name('exercice.show');
Route::post('exercice', 'ExerciceController@store')->name('exercice.store');
Route::put('exercice/{exercice}', 'ExerciceController@update')->name('exercice.update');
Route::post('exercice/{exercice}/restore', 'ExerciceController@restore')->name('exercice.restore'); 
Route::post('exercice/{exercice}/trash', 'ExerciceController@trash')->name('exercice.trash');
Route::post('exercice/{exercice}/destroy', 'ExerciceController@destroy')->name('exercice.destroy');
