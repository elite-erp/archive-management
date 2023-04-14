<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CPanelController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require_once app_path("Services/FetchDocuments.php");

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

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function () {
    Route::get('/', CPanelController::class)->name('cpanel');
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/users/{id}', [UsersController::class, 'uploadPhoto']);
    Route::resource('/users', UsersController::class);


    Route::get('/documents/{id}/print', [DocumentController::class, 'showPrint']);
    Route::resource('documents', DocumentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('attachments', AttachmentController::class);
});
