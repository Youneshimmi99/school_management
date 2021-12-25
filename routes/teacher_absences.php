<?php

Route::get('teacher_absences', 'TeacherAbsencesController@index')->name('teacher_absences.index');
Route::post('teacher_absences', 'TeacherAbsencesController@store')->name('teacher_absences.store');
Route::put('teacher_absences/{teacher_absences}', 'TeacherAbsencesController@update')->name('teacher_absences.update');