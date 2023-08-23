<?php

use App\Http\Controllers\NoteController;
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
Route::get('/notes/search/{keyword}', [NoteController::class, 'search']);