<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;

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
Route::get('/resume/index', [ResumeController::class,'index']);
Route::post('/resume/store', [ResumeController::class,'store']);
Route::get('/resume/show/{id}', [ResumeController::class,'show']);
Route::put('/resume/update/{id}',[ResumeController::class, 'update']);
Route::delete('/resume/delete/{id}',[ResumeController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
