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

Route::resource('companies', 'CompanyController', ['except' => 'destroy']);

Route::get('/companies/{company}/delete', ['as' => 'companies.destroy', 'uses' => 'CompanyController@destroy']);

Route::resource('roles', 'RoleController', ['except' => 'destroy']);

Route::get('/roles/{role}/delete', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy']);

Route::resource('stages', 'StageController', ['except' => 'destroy']);

Route::get('/stages/{stage}/delete', ['as' => 'stages.destroy', 'uses' => 'StageController@destroy']);

Route::resource('actions', 'ActionController', ['except' => 'destroy']);

Route::get('/actions/{action}/delete', ['as' => 'actions.destroy', 'uses' => 'ActionController@destroy']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
