<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteGroupController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ユーザー登録・ログイン・ログアウト
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// ログインユーザー取得
Route::get('/user', function() {
    $user = Auth::user();
    return $user ? new UserResource($user) : null;
});

// メモの操作
Route::get('/notes', [NoteController::class, 'fetch']);
Route::post('/notes', [NoteController::class, 'create']);
Route::put('/notes/{id}', [NoteController::class, 'update']);
Route::put('/notes/save/{id}', [NoteController::class, 'toggleSaveSetting']);
Route::delete('/notes/{id}', [NoteController::class, 'delete']);
Route::get('/notes/search/{note_group_id}', [NoteController::class, 'search']);

// メモグループの操作
Route::get('/note-groups', [NoteGroupController::class, 'fetch']);
Route::get('/note-groups/{note_group_id}', [NoteGroupController::class, 'show']);
Route::post('/note-groups', [NoteGroupController::class, 'create']);
Route::delete('/note-groups', [NoteGroupController::class, 'delete']);
Route::get('/note-groups/search/{keyword}', [NoteGroupController::class, 'search']);