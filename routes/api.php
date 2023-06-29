<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('send-email-reset-password', [AuthController::class, 'resetPasswordRequest']);
Route::post('reset-password', [AuthController::class, 'updatePassword']);
Route::get('get-user-to-register/{user:invite_token}', [AuthController::class, 'userToRegister']);
Route::post('register/{user:invite_token}', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', TicketController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('notes', NoteController::class);
    Route::resource('responses', ResponseController::class);
    Route::resource('statuses', StatusController::class);
    Route::resource('users', UserController::class);

    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});