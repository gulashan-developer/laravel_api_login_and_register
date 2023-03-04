<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('students',[App\Http\Controllers\API\StudentController::class, 'store']);
Route::get('students',[App\Http\Controllers\API\StudentController::class, 'index']);
Route::get('students/{id}',[App\Http\Controllers\API\StudentController::class, 'show']);
Route::put('students/{id}/update',[App\Http\Controllers\API\StudentController::class, 'update']);
Route::delete('students/{id}/delete',[App\Http\Controllers\API\StudentController::class, 'delete']);
