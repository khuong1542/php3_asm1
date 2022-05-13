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
    return view('welcome');
})->name('welcome');

Route::get('403', function(){
    return view('403');
})->name('403');

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'post_login'])->name('post_login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('reset-password/{id}', [UserController::class, 'reset_password'])->name('reset-password');
Route::post('reset-password/{id}', [UserController::class, 'updatepassword']);

Route::get('404',function(){
    return view('error.404');
});