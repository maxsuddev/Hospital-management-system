<?php

use App\Http\Controllers\CashBoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/test', function () {
//
//   dd(auth()->user()->roles());
//});

Route::group(['middleware' => ['auth']], function () {
//    Route::group(['middleware' => ['role_or_permission:super-admin']], function () {
        Route::get('role/{roleId}/give-permission', [RoleController::class, 'addPermissionToRole']);
        Route::put('role/{roleId}/give-permission', [RoleController::class, 'givePermissionToRole']);
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/service', [ServiceController::class, 'service'])->name('service.index');
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.index');
        Route::get('/', [CashBoxController::class, 'index'])->name('cash_box.index');
        Route::post('doctor/{id}/withdraw', [DoctorController::class, 'withdraw'])->name('doctor.withdraw');
        Route::post('cashbox/inkassa/{id}', [CashBoxController::class, 'inkassa'])->name('cashbox.inkassa');
        Route::get('/cost',[CashBoxController::class, 'create'])->name('cost');
        Route::post('cost', [CashBoxController::class, 'cost'])->name('cashbox.cost');
        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('doctor', DoctorController::class);
        Route::resource('order', OrderController::class);
//    });
//
//    Route::group(['middleware' => ['role:admin|super-admin']], function () {
//        Route::resource('category', CategoryController::class);
//        Route::resource('service', ServiceController::class);
//    });
//    Route::group(['middleware' => ['role:admin|cashier|super-admin']], function () {
//        Route::resource('doctor', DoctorController::class);
//        Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.index');
//
//    });
//
//
//    Route::group(['middleware' => ['role:cashier|super-admin']], function () {
//        Route::resource('order', OrderController::class);
//        Route::post('doctor/{id}/withdraw', [DoctorController::class, 'withdraw'])->name('doctor.withdraw');
//        Route::post('cashbox/inkassa/{id}', [CashBoxController::class, 'inkassa'])->name('cashbox.inkassa');
//        Route::get('/cost',[CashBoxController::class, 'create'])->name('cost');
//        Route::post('cost', [CashBoxController::class, 'cost'])->name('cashbox.cost');
//        Route::get('/', [CashBoxController::class, 'index'])->name('cash_box.index');
//    });

//    Route::middleware([
//        'auth:sanctum',
//        config('jetstream.auth_session'),
//        'verified',
//    ])->group(function () {
//        Route::get('/dashboard', function () {
//            return view('dashboard');
//        })->name('dashboard');
//    });
});
