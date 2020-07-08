<?php

use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    return Redirect::to('/login');
})->name('login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Patients Controller Routes
Route::get('/patients', 'PatientsController@index')->name('patients.index');
Route::get('/patients/create', 'PatientsController@create')->name('patients.create');
Route::post('/patients/store', 'PatientsController@store')->name('patients.store');
Route::get('/patients/currentMonth', 'PatientsController@getPatients')->name('patients.month');
Route::put('/patients/{patient}/edit', 'PatientsController@edit')->name('patients.edit');
Route::get('/patients/{patient}/show', 'PatientsController@show')->name('patients.show');
Route::get('/patients/{patient}/print', 'PatientsController@print')->name('patients.print');
Route::get('/patients/{patient}/printAndSave', 'PatientsController@printAndSave')->name('patients.printAndSave');
Route::delete('/patients/{patient}/destroy', 'PatientsController@destroy')->name('patients.destroy');

// Employees Controller Routes
Route::get('/employees', 'EmployeesController@index')->name('employees.index');
Route::post('/employees/store', 'EmployeesController@store')->name('employees.store');
Route::get('/employees/create', 'EmployeesController@create')->name('employees.create');
Route::delete('/employees/{employee}/destroy', 'EmployeesController@destroy')->name('employees.destroy');
Route::get('/employees/{employee}/show', 'EmployeesController@show')->name('employees.show');


// Pharamacy Controller Routes
Route::get('/sales', 'SalesController@index')->name('sales.index');
Route::get('/sales/list', 'SalesController@list')->name('sales.list');
// Route::delete('/sales/{sale}/destroy', 'SalesController@destroy')->name('sales.destroy');
Route::post('/sales/items', 'SalesController@storeItems')->name('sales.storeItems');
Route::get('/sales/medicine', 'SalesController@create')->name('sales.medicine');
Route::get('/sales/print/{id}', 'SalesController@print')->name('sales.print');
Route::get('/sales/{medicine}/show', 'SalesController@show')->name('sales.show');
Route::get('/sales/search/{search}', 'SalesController@search');

// Medicines Controller Routes
Route::get('/medicine', 'MedicinesController@index')->name('medicine.index');
Route::get('/medicine/list', 'MedicinesController@list')->name('medicine.list');
Route::post('/medicine/store', 'MedicinesController@store')->name('medicine.store');
Route::post('/medicine/show', 'MedicinesController@show')->name('medicine.show');
Route::get('/medicine/{medicine}/edit', 'MedicinesController@edit')->name('medicine.edit');
Route::post('/medicine/{medicine}/update/', 'MedicinesController@update')->name('medicine.update');
Route::delete('/medicine/{medicine}/destroy', 'MedicinesController@destroy')->name('medicine.destroy');

// User Controller Routes
Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
Route::get('/users/{user}/show', 'UserController@show')->name('users.show');

Route::get('/audit', 'AuditController@index')->name('audit.index');
Route::post('/audit/showPatients/', 'AuditController@showPatients')->name('audit.showPatients');
Route::post('/audit/showMedicine/', 'AuditController@showMedicine')->name('audit.showMedicine');
/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::get('/patients/search/{name}', 'PatientsController@getPatientsList')->name('patients.all');
