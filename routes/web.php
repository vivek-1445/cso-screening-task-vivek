<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('add', [UserController::class, 'add'])->name('user.add');
Route::get('get', [UserController::class, 'get'])->name('user.get');
Route::get('edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('update', [UserController::class, 'update'])->name('user.update');
Route::delete('delete', [UserController::class, 'delete'])->name('user.delete');