<?php

// Route::get('/grade','Gradecontroller@index')->middleware('admin');
Route::resource('grade', 'GradeController');