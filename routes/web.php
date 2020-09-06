<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['as' => 'entry.index', 'uses' => 'entryController@index']);


Route::resource('agencies', 'AgencyController', ['except' => 'edit, update']);

Route::get('/agencies/{agency_id}/{contact_id}/{entry_id}/update', ['as' => 'agencies.update', 'uses' => 'AgencyController@update']);


Route::get('/agencies/{agency_id}/{contact_id}/{entry_id}/edit', ['as' => 'agencies.edit', 'uses' => 'AgencyController@edit']);

Route::resource('entries', 'EntryController', ['except' => 'destroy']);

Route::get('/entries/{entry}/delete', ['as' => 'entries.destroy', 'uses' => 'EntryController@destroy']);

Route::resource('contacts', 'ContactController', ['except' => 'edit, destroy']);

Route::get('/contacts/{contact_id}/{entry_id}/edit', ['as' => 'contacts.edit', 'uses' => 'ContactController@edit']);

Route::get('/contacts/{contact}/delete', ['as' => 'contacts.destroy', 'uses' => 'ContactController@destroy']);

Route::resource('companies', 'CompanyController', ['except' => 'create, edit, destroy']);

Route::get('/companies/{contact_id}/create', ['as' => 'companies.create', 'uses' => 'CompanyController@create']);

Route::get('/companies/{company_id}/{entry_id}/edit', ['as' => 'companies.edit', 'uses' => 'CompanyController@edit']);

Route::post('/companies/{company}/delete', ['as' => 'companies.destroy', 'uses' => 'CompanyController@destroy']);

Route::resource('roles', 'RoleController', ['except' => 'create, edit, destroy']);

Route::get('/roles/{contact_id}/{company_id}/create', ['as' => 'roles.create', 'uses' => 'RoleController@create']);

Route::get('/roles/{role}/{entry_id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);

Route::post('/roles/{role}/delete', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy']);

Route::resource('stages', 'StageController', ['except' => 'create, edit, destroy']);

Route::get('/stages/{contact_id}/{company_id}/{role_id}/create', ['as' => 'stages.create', 'uses' => 'StageController@create']);

Route::get('/stages/{stage}/{entry_id}/{contact_id}/{company_id}/edit', ['as' => 'stages.edit', 'uses' => 'StageController@edit']);

Route::post('/stages/{stage}/delete', ['as' => 'stages.destroy', 'uses' => 'StageController@destroy']);

Route::resource('actions', 'ActionController', ['except' => 'create, destroy']);

Route::get('/actions/{contact_id}/{company_id}/{role_id}/{stage_id}/create', ['as' => 'actions.create', 'uses' => 'ActionController@create']);

Route::post('/actions/{action}/delete', ['as' => 'actions.destroy', 'uses' => 'ActionController@destroy']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
