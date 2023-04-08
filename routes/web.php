<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CPanelController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', CPanelController::class)->name('cpanel');
Route::get('/profile', [AuthController::class, 'profile']);
Route::resource('/users', UsersController::class);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('documents', DocumentController::class );
Route::resource('categories', CategoryController::class );
Route::resource('attachments', AttachmentController::class);
