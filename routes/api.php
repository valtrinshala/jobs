<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\ExternalJobs\ExternalJobsCreateController;
use App\Http\Controllers\API\V1\ExternalJobs\ExternalJobsShowController;
use App\Http\Controllers\API\V1\LocalJobs\LocalJobsCreateController;
use App\Http\Controllers\API\V1\LocalJobs\LocalJobsShowController;
use App\Http\Controllers\API\V1\Tenders\TendersCreateController;
use App\Http\Controllers\API\V1\Tenders\TendersShowController;
use App\Http\Controllers\API\V1\Grants\GrantsCreateController;
use App\Http\Controllers\API\V1\Grants\GrantsShowController;
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

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/tenders', TendersCreateController::class);
Route::get('/tenders', TendersShowController::class);

Route::post('/local-jobs', LocalJobsCreateController::class);
Route::get('/local-jobs', LocalJobsShowController::class);

Route::post('/external-jobs', ExternalJobsCreateController::class);
Route::get('/external-jobs', ExternalJobsShowController::class);

Route::post('/grants', GrantsCreateController::class);
Route::get('/grants', GrantsShowController::class);

