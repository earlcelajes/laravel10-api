<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employees', [EmployeeController::class, 'index']);
Route::post('employees', [EmployeeController::class, 'store']);
Route::get('employees/{id}', [EmployeeController::class, 'show']);
Route::get('employees/{id}/edit', [EmployeeController::class, 'edit']);
Route::put('employees/{id}/edit', [EmployeeController::class, 'update']);
Route::delete('employees/{id}/delete', [EmployeeController::class, 'destroy']);