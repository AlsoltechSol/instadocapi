<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\LabController;
use App\Http\Controllers\API\TestcenterController;
use App\Http\Controllers\API\BaseController;


  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
Route::post('login', [AuthController::class, 'signin']);
Route::post('sendotp', [AuthController::class, 'sendotp']);
Route::post('register', [AuthController::class, 'signup']);
// Route::get('test', [AuthController::class, 'test']);




Route::middleware('auth:sanctum')->group( function () {
    Route::resource('patients', PatientController::class);
    Route::resource('labtest', LabController::class);
    Route::resource('testcenters', TestcenterController::class);
});