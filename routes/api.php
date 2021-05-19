<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::pattern('user_id', '0x[0-9a-zA-Z]{40}');

//API For Users

Route::get('users', [UserController::class, 'index']);
Route::get('users/{user_id}', [UserController::class, 'show']);
Route::get('users/{user_id}/reports', [ReportController::class, 'getUserReports']);
Route::get('users/{user_id}/programs', [ProgramController::class, 'getUserPrograms']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/{user_id}', [UserController::class, 'update']);
Route::delete('users/{user_id}', [UserController::class, 'destroy']);
Route::put('users/{user_id}/ban', [UserController::class, 'ban']);

//API For Admins

Route::get('admins', [AdminController::class, 'index']);
Route::get('admins/{user_id}', [AdminController::class, 'show']);
Route::post('admins', [AdminController::class, 'store']);
Route::post('admins/{user_id}', [AdminController::class, 'update']);
Route::delete('admins/{user_id}', [AdminController::class, 'destroy']);

// API For Companies

Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{id}', [CompanyController::class, 'show']);
Route::get('companies/{id}/code', [CompanyController::class, 'getCodes']);
Route::get('companies/{id}/managers', [CompanyController::class, 'getManagers']);
Route::get('companies/{id}/programs', [ProgramController::class, 'getCompanyPrograms']);
Route::get('companies/{id}/reports', [ReportController::class, 'getCompanyReports']);
Route::post('companies/{id}/managers', [CompanyController::class, 'addManager']);
Route::delete('companies/{id}/managers/{manager_id}', [CompanyController::class, 'deleteManager']);
Route::post('companies', [CompanyController::class, 'store']);
Route::post('companies/{id}', [CompanyController::class, 'update']);
Route::delete('companies/{id}', [CompanyController::class, 'destroy']);
Route::post('companies/{id}/code', [CompanyController::class, 'generate']);




//API For Programs

Route::get('programs', [ProgramController::class, 'index']);
Route::get('programs/{id}', [ProgramController::class, 'show']);
Route::get('programs/{id}/users', [ProgramController::class, 'getUsers']);
Route::get('programs/{id}/reports', [ReportController::class, 'getProgramReports']);
Route::post('programs', [ProgramController::class, 'store']);
Route::post('programs/{id}', [ProgramController::class, 'update']);
Route::delete('programs/{id}', [ProgramController::class, 'destroy']);


//API For Reports

Route::get('reports', [ReportController::class, 'index']);
Route::get('reports/{id}', [ReportController::class, 'show']);
Route::post('reports', [ReportController::class, 'store']);
Route::post('reports/{id}', [ReportController::class, 'update']);
Route::delete('reports/{id}', [ReportController::class, 'destroy']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
