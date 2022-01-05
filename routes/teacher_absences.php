<?php

Route::get('teacher_absences', 'TeacherAbsencesController@index')->name('teacher_absences.index');
Route::get('teacher_absence/{teacher_absence}', 'TeacherAbsencesController@show')->name('teacher_absence.show');
Route::get('teacher_absences/{teacher_absences}', 'TeacherAbsencesController@teacherAbsences')->name('teacher_absences.teacherAbsences');
Route::post('teacher_absences', 'TeacherAbsencesController@store')->name('teacher_absences.store');
Route::put('teacher_absences/{teacher_absences}', 'TeacherAbsencesController@update')->name('teacher_absences.update');
Route::delete('teacher_absence/{teacher_absence}/destroy', 'TeacherAbsencesController@destroy')->name('teacher_absence.destroy');