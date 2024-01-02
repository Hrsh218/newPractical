<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
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
    // return view('welcome');
    return view('register');
})->name('register');


Route::post('post-register', [AuthController::class, 'postRegister'])->name('auth.register');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('postLogin', [AuthController::class, 'postLogin'])->name('auth.postLogin');

Route::middleware(['auth'])->group(function () {
    Route::get('team/index', [TeamController::class, 'index'])->name('team.index');

    Route::get('edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
    Route::post('edit/update/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::get('team/delete/{id}', [TeamController::class, 'destroy'])->name('team.delete');

    Route::get('player/create', [PlayerController::class, 'create'])->name('player.create');
    Route::post('player/store', [PlayerController::class, 'store'])->name('player.store');

    Route::get('player/index', [PlayerController::class, 'index'])->name('player.index');

    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});



// Route::get('/', function () {
//     return view('welcome');
// });
