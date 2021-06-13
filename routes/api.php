<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\ManagerController;
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

Route::pattern('user_id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('id', '[0-9]*');

//API For Users
Route::post('login', [AuthController::class, 'login']);
Route::post('sign', [AuthController::class, 'sign']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => ['is.auth']], function() {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::post('edit', [UserController::class, 'update']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('programs_status', [StatController::class, 'getProgramsStatus']);//status_prog_count
Route::get('programs_stats', [StatController::class, 'getProgramsStats']);//prog stats
Route::get('evolution', [StatController::class, 'Evolution']); //bounty evolution
Route::get('reports_stats', [StatController::class, 'getUserReportsStats']);//reports status_count and severity_count

Route::get('programs', [ProgramController::class, 'index']);
Route::post('programs/search', [ProgramController::class, 'searchProgram']);
Route::get('programs/{id}', [ProgramController::class, 'show']);
Route::post('programs/{id}/join', [ProgramController::class, 'join']);
Route::get('programs/{id}/users', [ProgramController::class, 'getUsers']);
Route::get('programs/{id}/reports', [ReportController::class, 'getProgramReports']);
Route::get('programs/{id}/my_report', [ReportController::class, 'getMyProgramrReport']);
Route::post('programs/{id}/report', [ReportController::class, 'store']);
Route::post('programs/{id}/reports/{report_id}', [ReportController::class, 'update']);
Route::get('reports/{id}', [ReportController::class, 'show']);
Route::get('users', [UserController::class, 'index']);
Route::post('users/search', [UserController::class, 'searchUser']);
Route::get('users/{user_id}', [UserController::class, 'show']);
Route::get('users/{user_id}/reports', [ReportController::class, 'getUserReports']);
Route::get('users/{user_id}/programs', [ProgramController::class, 'getUserPrograms']);
Route::get('me/reports', [ReportController::class, 'getMyReports']);
Route::get('reports', [ReportController::class, 'index']);
Route::get('me/programs', [ProgramController::class, 'getMyPrograms']);
Route::post('me/reports', [ReportController::class, 'getFiltredReports']);
Route::get('me/messages', [ReportMessageController::class, 'getMessages']);
Route::post('reports/{id}/messages', [ReportMessageController::class, 'store']);
Route::get('reports/{id}/messages', [ReportMessageController::class, 'getReportMessages']);

Route::post('request_company', [ManagerController::class, 'requestCompany']);

