<?php

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


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/group-by', [UserController::class, 'dashboard'])->name('users.dashboard');
Route::get('/users/export', [UserController::class, 'export']);

require __DIR__.'/auth.php';
