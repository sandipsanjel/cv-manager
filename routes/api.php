<?php

use App\Http\Controllers\ApiController\UserCVApiController;
use App\Http\Controllers\ApiController\CVstatusApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::get('cv', [UserCVApiController::class, 'apiindex']);
Route::post('store/cv', [UserCVApiController::class, 'apistore']);
Route::get('users', [UserCVApiController::class, 'apiuserslist']);
Route::post('login', [UserCVApiController::class, 'apiuserslogin']);
Route::post('signup', [UserCVApiController::class, 'apiuserssignup']);
Route::get('status/cv', [CVstatusApiController::class, 'apicvstatus']);
Route::get('induser/cv/{id}', [CVstatusApiController::class, 'indusercv']);
Route::post('update/cv/{id}', [CVstatusApiController::class, 'apiupdatecvstatus']);
Route::post('delete/cv/{id}', [CVstatusApiController::class, 'apideletecvstatus']);
