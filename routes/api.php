<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\MhsController;
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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login'])->name('login');
//Route::get('mhs', [MhsController::class, 'mhs'])->middleware('jwt.verify');
Route::get('item', [ItemController::class, 'itemAuth'])->middleware('jwt.verify');
Route::get('item/{item_id}', [ItemController::class, 'itemDetail'])->middleware('jwt.verify');
Route::get('user', [UserController::class, 'getAuthenticatedUser'])->middleware('jwt.verify');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
