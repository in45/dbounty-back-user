<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
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
Route::post('users', [UserController::class, 'store']);
Route::post('users/{user_id}', [UserController::class, 'update']);
Route::delete('users/{user_id}', [UserController::class, 'destroy']);

// API For Companies

Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{id}', [CompanyController::class, 'show']);
Route::get('companies/{id}/managers', [CompanyController::class, 'getManagers']);
Route::post('companies/{id}/managers', [CompanyController::class, 'addManager']);
Route::delete('companies/{id}/managers/{manager_id}', [CompanyController::class, 'deleteManager']);
Route::post('companies/{id}', [CompanyController::class, 'update']);
Route::post('companies/{id}/avatar', [CompanyController::class, 'updateAvatar']);
Route::delete('companies/{id}', [CompanyController::class, 'destroy']);

// API For Badges

Route::get('badges', [BadgeController::class, 'index']);
Route::get('badges/{id}',  [BadgeController::class, 'show']);
Route::get('me/badges', [BadgeController::class, 'getMyBadges']);
Route::get('users/{user_id}/badges', [BadgeController::class, 'getBadgesOfUser']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
