<?php
Route::get('classe/archive', 'ClasseController@archive')->name('classe.archive'); 
// Route::resource('classe', 'ClasseController',['except'=>['destroy']]);
Route::delete('classe/{classe}/trash', 'ClasseController@trash')->name('classe.trash');
Route::delete('classe/{classe}/destroy', 'ClasseController@destroy')->name('classe.destroy');
