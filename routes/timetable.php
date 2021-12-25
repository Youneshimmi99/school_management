<?php

// Route::resource('timetable', 'TimetableController');

Route::post('timetable', 'TimetableController@store')->name('timetable.store');
Route::get('timetable/{timebtable}', 'TimetableController@show')->name('timetable.show');
Route::put('timetable/{timebtable}', 'TimetableController@update')->name('timetable.update');
