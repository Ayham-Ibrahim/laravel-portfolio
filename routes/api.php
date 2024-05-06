<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SkillController;

use App\Http\Controllers\MessageController;

use App\Http\Controllers\AuthController;




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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});



Route::apiResource('employees', EmployeeController::class);
Route::apiResource('messages', MessageController::class);
Route::get('/skills', [SkillController::class, 'index']);
Route::post('/add/skills', [SkillController::class, 'store']);
Route::get('/show/skills/{id}', [SkillController::class, 'show']);
Route::put('/udate/skills/{id}', [SkillController::class, 'update']);
Route::delete('/delete/skills/{id}', [SkillController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


