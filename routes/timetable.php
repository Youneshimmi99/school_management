<?php

// Route::resource('timetable', 'TimetableController');
Route::get('teacherTimetable/{teacherTimetable}', 'TimetableController@teacherTimetable')->name('timetable.teacherTimetable');
Route::get('teachersWithoutTimetable', 'TimetableController@teachersWithoutTimetable')->name('timetable.teachersWithoutTimetable');
// Route::get('studentTimetable/{studentTimetable}', 'TimetableController@studentTimetable')->name('timetable.studentTimetable');
Route::post('timetable', 'TimetableController@store')->name('timetable.store');
Route::get('timetable/{timebtable}', 'TimetableController@show')->name('timetable.show');
Route::put('timetable/{timebtable}', 'TimetableController@update')->name('timetable.update');

Route::post('/timetable/classe', 'TimetableController@CreateTimeTableClasse');
Route::get('/getclassesInfo/{id}', 'TimetableController@GetInfoClasse');
Route::post('/delete/timetable/classe/{id}', 'TimetableController@DeleteTimetableClasse');
