<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ThreadController;
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


Route::apiResource('messages', MessageController::class);
Route::get('conversations/{conversation_id}/messages', [MessageController::class, 'index']);

Route::apiResource('conversations', ConversationController::class);
Route::apiResource('threads', ThreadController::class);
Route::apiResource('users', UserController::class);