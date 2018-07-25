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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/users/{id}/assignedroles', 'AssignedroleController@index')->name('abilities');
Route::get('/users', 'UserController@index')->name('users');

Route::get('/roles', 'RoleController@index')->name('roles');
Route::get('/roles/create', 'RoleController@create')->name('roles');
Route::get( '/roles/search', array('as' => 'roles.search', 'uses' => 'RoleController@search'));
Route::get('/roles/{id}/permissions', 'PermissionController@index')->name('permissions');
Route::post('/roles', [ 'as' => 'roles.store', 'uses' => 'RoleController@store']);
Route::get('/roles/{id}/destroy', 'RoleController@destroy')->name('roles');

Route::get('/abilities/create', 'AbilitieController@create')->name('abilities');
Route::get('/abilities', 'AbilitieController@index')->name('abilities');
Route::post('/abilities', [ 'as' => 'abilities.store', 'uses' => 'AbilitieController@store']);
Route::get( '/abilities/search', array('as' => 'abilities.search', 'uses' => 'AbilitieController@search'));

Route::post('/assignedroles', [ 'as' => 'assignedroles.store', 'uses' => 'AssignedroleController@store']);
Route::post('/permissions', [ 'as' => 'permissions.store', 'uses' => 'PermissionController@store']);

Route::post('/huertas/finder', [ 'as' => 'huertas.finder', 'uses' => 'HuertaController@finder']);
Route::get('/huertas/{id}/destroy', 'HuertaController@destroy')->name('huertas');
Route::get( '/huertas/search', array('as' => 'huertas.search', 'uses' => 'HuertaController@search'));
Route::get('/huertas/{id}/arbols', 'ArbolController@index')->name('arbols');
Route::resource('huertas', 'HuertaController');

Route::post('/arbols/finder', [ 'as' => 'arbols.finder', 'uses' => 'ArbolController@finder']);
Route::get('/arbols/{id}/destroy', 'ArbolController@destroy')->name('arbols');
Route::get( '/arbols/search', array('as' => 'arbols.search', 'uses' => 'ArbolController@search'));

Route::get('/arbols/{id}/create', 'ArbolController@create')->name('arbols');
Route::resource('arbols', 'ArbolController');

Route::get( '/maestros/search', array('as' => 'maestros.search', 'uses' => 'MaestroController@search'));

Route::post('/especies/finder', [ 'as' => 'especies.finder', 'uses' => 'EspecieController@finder']);
Route::get('/especies/{id}/destroy', 'EspecieController@destroy')->name('especies');
Route::get( '/especies/search', array('as' => 'especies.search', 'uses' => 'EspecieController@search'));
Route::resource('especies', 'EspecieController');
