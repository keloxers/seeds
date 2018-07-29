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
Route::get('/huertas/{huertas_id}/especies/{especies_id}/familias/{familias_id}', 'GenotipoController@index')->name('genotipos');
Route::get('/huertas/{id}/manejos', 'ManejoController@index')->name('manejos');
Route::resource('huertas', 'HuertaController');

Route::post('/genotipos/finder', [ 'as' => 'genotipos.finder', 'uses' => 'GenotipoController@finder']);
Route::get('/genotipos/{id}/destroy', 'GenotipoController@destroy')->name('genotipos');
Route::get( '/genotipos/search', array('as' => 'genotipos.search', 'uses' => 'GenotipoController@search'));
Route::get('/genotipos/{id}/create', 'GenotipoController@create')->name('genotipos');
Route::resource('genotipos', 'GenotipoController');

Route::post('/especies/finder', [ 'as' => 'especies.finder', 'uses' => 'EspecieController@finder']);
Route::get('/especies/{id}/destroy', 'EspecieController@destroy')->name('especies');
Route::get( '/especies/search', array('as' => 'especies.search', 'uses' => 'EspecieController@search'));
Route::get('/especies/{id}/familias', 'FamiliaController@index')->name('familias');
Route::resource('especies', 'EspecieController');

Route::post('/familias/finder', [ 'as' => 'familias.finder', 'uses' => 'FamiliaController@finder']);
Route::get('/familias/{id}/destroy', 'FamiliaController@destroy')->name('familias');
Route::get( '/familias/search', array('as' => 'familias.search', 'uses' => 'FamiliaController@search'));
Route::get( '/familias/{id}/create', array('as' => 'familias.create', 'uses' => 'FamiliaController@create'));

Route::resource('familias', 'FamiliaController');

Route::post('/aplicacions/finder', [ 'as' => 'aplicacions.finder', 'uses' => 'AplicacionController@finder']);
Route::get('/aplicacions/{id}/destroy', 'AplicacionController@destroy')->name('aplicacions');
Route::get( '/aplicacions/search', array('as' => 'aplicacions.search', 'uses' => 'AplicacionController@search'));
Route::resource('aplicacions', 'AplicacionController');

Route::post('/manejos/finder', [ 'as' => 'manejos.finder', 'uses' => 'ManejoController@finder']);
Route::get( '/manejos/{id}/create', array('as' => 'manejos.create', 'uses' => 'ManejoController@create'));
Route::get( '/manejos/{id}/areas', array('as' => 'areas.index', 'uses' => 'AreaController@index'));
Route::resource('manejos', 'ManejoController');

Route::post('/areas/finder', [ 'as' => 'areas.finder', 'uses' => 'AreaController@finder']);
Route::get('/areas/{id}/destroy', 'AreaController@destroy')->name('areas');
Route::get( '/areas/search', array('as' => 'areas.search', 'uses' => 'AreaController@search'));
Route::get( '/areas/{id}/create', array('as' => 'areas.create', 'uses' => 'AreaController@create'));
Route::resource('areas', 'AreaController');

Route::post('/origens/finder', [ 'as' => 'origens.finder', 'uses' => 'OrigenController@finder']);
Route::get('/origens/{id}/destroy', 'OrigenController@destroy')->name('origens');
Route::get( '/origens/search', array('as' => 'origens.search', 'uses' => 'OrigenController@search'));
Route::get( '/origens/create', array('as' => 'origens.create', 'uses' => 'OrigenController@create'));

Route::resource('origens', 'OrigenController');
