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

// User Controller Routes
Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
Route::get('/users/{user}/show', 'UserController@show')->name('users.show');
/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/
Route::get('/patients/search/{name}', 'PatientsController@getPatientsList')->name('patients.all');
