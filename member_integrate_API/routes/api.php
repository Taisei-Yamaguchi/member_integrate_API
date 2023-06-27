<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IntegrateController;
use App\Http\Middleware\APIAuthentificationMiddleware;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//2023.6.25 middlewareでAPIrequestの認証をします。
Route::post('get_member',[IntegrateController::class,'getMember1'])->middleware(APIAuthentificationMiddleware::class);
Route::post('get_member2',[IntegrateController::class,'getMember2'])->middleware(APIAuthentificationMiddleware::class);
