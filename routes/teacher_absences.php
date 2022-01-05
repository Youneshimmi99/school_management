<?php

Route::get('teacher_absences', 'TeacherAbsencesController@index')->name('teacher_absences.index');
Route::get('/teacher_absence/{teacher_absence}', 'TeacherAbsencesController@show')->name('teacher_absence.show');
Route::get('/teacher_absences', 'TeacherAbsencesController@teacherAbsences')->name('teacher_absences.teacherAbsences');
Route::post('teacher_absences', 'TeacherAbsencesController@store')->name('teacher_absences.store');
Route::post('/update/teacher/absence/{id}', 'TeacherAbsencesController@update')->name('teacher_absences.update');
Route::post('/teacher_absence/destroy/{teacher_absence}', 'TeacherAbsencesController@destroy')->name('teacher_absence.destroy');