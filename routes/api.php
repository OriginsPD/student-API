<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\StudentController;



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




Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);



// Routes For Student Information

Route::get('/get-student', [StudentController::class, 'index']);

Route::get('/find-student/{id}', [StudentController::class, 'show']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    // Student Operation Protected By Auth Sanctum Middleware
    Route::post('/add-student', [StudentController::class, 'store']);

    Route::post('/update-student/{id}', [StudentController::class, 'update']);

    Route::delete('/delete-student/{id}', [StudentController::class, 'delete']);


    // Delete Token And Logout User
    Route::get('/logout', [AuthController::class, 'logout']);
});
