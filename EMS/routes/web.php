<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('employee', \App\Http\Controllers\EmployeeController::class);
Route::resource('department', \App\Http\Controllers\DepartmentController::class);
