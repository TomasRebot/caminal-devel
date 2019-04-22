<?php

Auth::routes();



Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/listado-general', 'DashboardController@index');
});

Route::group(['prefix' => 'pacientes'], function () {
    Route::get('/listado-general', 'PacienteController@index');
    Route::get('/crear-paciente', 'PacienteController@store');
    Route::get('/editar-paciente', 'PacienteController@update');
    Route::get('/cambiar-estado-pacientes', 'PacienteController@changeState');
});

Route::group(['prefix' => 'profesionales'], function () {
    Route::get('/listado-general', 'ProfesionalController@index');
    Route::get('/crear-profesional', 'ProfesionalController@store');
    Route::get('/editar-profesional', 'ProfesionalController@update');
    Route::get('/cambiar-estado-profesionales', 'ProfesionalController@changeState');
});

Route::group(['prefix' => 'instituciones'], function () {
    Route::get('/listado-general', 'InstitucionController@index');
    Route::get('/crear-institucion', 'InstitucionController@store');
    Route::get('/editar-institucion', 'InstitucionController@update');
    Route::get('/cambiar-estado-instituciones', 'InstitucionController@changeState');
});

// Route::group(['prefix' => 'medicamentos'], function () {
//     Route::get('/listado-general', 'MedicamentoController@index');
//     Route::get('/crear-medicamento', 'MedicamentoController@store');
//     Route::get('/editar-medicamento', 'MedicamentoController@update');
//     Route::get('/cambiar-estado-medicamento', 'MedicamentoController@changeState');
// });
