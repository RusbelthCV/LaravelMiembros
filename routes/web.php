<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('Login','Login@comprobar');

Route::get('Logout','Login@logOut');

Route::get('lista','miembros@list');

Route::get('/editar/{id}','miembros@miembroId');

Route::post('editar','miembros@editar');

Route::get('add',function() {
    return view('addMiembro');
});

Route::post('agregar','miembros@agregar');

Route::get('/borrar/{id}','miembros@borrar');

Route::post('delete','miembros@delete');

Route::post('busqueda','miembros@busqueda');
