<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillController;

use App\Http\Controllers\ResumeController;

use App\Http\Controllers\MessageController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserInfoController;




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


################## Auth #############################
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});


Route::middleware('auth')->group(function () {

});


################## messages #############################
Route::apiResource('messages', MessageController::class);


################## userInfo #############################
Route::apiResource('/userInfo',UserInfoController::class);


################## Skills #############################
Route::get('/skills', [SkillController::class, 'index']);
Route::post('/add_skill', [SkillController::class, 'store']);
Route::get('/show_skill/{skill}', [SkillController::class, 'show']);
Route::put('/update_skill/{skill}', [SkillController::class, 'update']);
Route::delete('/delete_skill/{skill}', [SkillController::class, 'destroy']);


################## Project #############################
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('project/{project}', [ProjectController::class, 'show']);
Route::post('add-project', [ProjectController::class, 'store']);
Route::put('update-project/{project}', [ProjectController::class, 'update']);
Route::delete('delete-project/{project}', [ProjectController::class, 'destroy']);


################## Resume #############################
Route::get('/resume', [ResumeController::class,'index']);
Route::post('add-resume', [ResumeController::class,'store']);
Route::get('resume/{resume}', [ResumeController::class,'show']);
Route::put('update-resume/{resume}',[ResumeController::class, 'update']);
Route::delete('delete-resume/{resume}',[ResumeController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




