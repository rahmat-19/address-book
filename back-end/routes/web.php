<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::get('/users/dashboard/group-by', [ContactController::class, 'dashboard'])->name('users.dashboard');
Route::get('/users', [ContactController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [ContactController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [ContactController::class, 'destroy'])->name('users.show');
Route::post('/users', [ContactController::class, 'store'])->name('users.store');
Route::patch('/users/{id}', [ContactController::class, 'update'])->name('users.update');
Route::get('/users/document/export', [ContactController::class, 'export']);

require __DIR__.'/auth.php';
