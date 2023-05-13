<?php

use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\UserController;
use App\Models\Kendaraan;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("auth")->group(function(){
    Route::post("/login", [UserController::class, 'Login']);
    Route::post("/register", [UserController::class, 'Register']);
    Route::post("/logout", [UserController::class, 'Logout']);
});

Route::prefix("kendaraan")->middleware('jwt.verify')->group(function(){
    Route::get("/all", [KendaraanController::class, "GetAll"]);
    Route::get("/{{id}}", [KendaraanController::class, "GetById"]);
    Route::post("/create", [KendaraanController::class, "Create"]);
    Route::post("/update/{id}", [KendaraanController::class, "Update"]);
});