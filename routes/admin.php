<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin-role'], function () {
        Route::get('create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::post('update_role_id/{id}', [AdminController::class, 'update_role_id'])->name('admin.update_role_id');
        Route::post('update-role/{id}', [AdminController::class, 'update_role'])->name('admin.update.role');
        Route::prefix('staffs')->group(function () {
            Route::DELETE('{staff}', [StaffController::class, 'destroy'])->name('staffs.destroy');
            Route::get('create', [MemberController::class, 'create'])->name('staffs.create');
            Route::post('store', [MemberController::class, 'store'])->name('staffs.store');
        });
        Route::prefix('members')->group(function () {
            Route::get('create', [MemberController::class, 'create'])->name('members.create');
            Route::post('store', [MemberController::class, 'store'])->name('members.store');
            Route::DELETE('{member}', [MemberController::class, 'destroy'])->name('members.destroy');
        });
    });
    Route::group(['middleware' => ['admin-staff-role']], function () {
        Route::prefix('cars')->group(function () {
            Route::get('create', [CarController::class, 'create'])->name('cars.create');
            Route::post('store', [CarController::class, 'store'])->name('cars.store');
            Route::get('{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
            Route::post('{car}', [CarController::class, 'update'])->name('cars.update');
            Route::DELETE('{car}', [CarController::class, 'destroy'])->name('cars.destroy');
        });
        Route::prefix('passengers')->group(function () {
            Route::get('create', [PassengerController::class, 'create'])->name('passengers.create');
            Route::post('store', [PassengerController::class, 'store'])->name('passengers.store');
            Route::get('{passenger}/edit', [PassengerController::class, 'edit'])->name('passengers.edit');
            Route::post('{passenger}', [PassengerController::class, 'update'])->name('passengers.update');
            Route::DELETE('{passenger}', [PassengerController::class, 'destroy'])->name('passengers.destroy');
        });
        Route::prefix('staffs')->group(function () {
            Route::get('{staff}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
            Route::post('{staff}', [StaffController::class, 'update'])->name('staffs.update');
        });
    });
    Route::prefix('members')->group(function () {
        Route::get('/', [MemberController::class, 'index'])->name('members.index');
        Route::get('{member}', [MemberController::class, 'show'])->name('members.show');
        Route::get('{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::post('{member}', [MemberController::class, 'update'])->name('members.update');
    });
    Route::get('cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('passengers', [PassengerController::class, 'index'])->name('passengers.index');
    Route::get('passengers/{passenger}', [PassengerController::class, 'show'])->name('passengers.show');
    Route::get('staffs', [StaffController::class, 'index'])->name('staffs.index');
    Route::get('staffs/{staff}', [StaffController::class, 'show'])->name('staffs.show');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('list_admin', [AdminController::class, 'list_admin'])->name('admin.list');
    Route::get('change-password', [UserController::class, 'change_password'])->name('change-password');
    Route::post('change-password', [UserController::class, 'repassword']);
    // Route::resource('cars', CarController::class);
    // Route::resource('passengers', PassengerController::class);
    // Route::resource('members', MemberController::class);
    // Route::resource('staffs', StaffController::class);
    Route::resource('users', UserController::class);
    Route::get('infomation/{id}', [UserController::class, 'infomation'])->name('user.infomation');
});
