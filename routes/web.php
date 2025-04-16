<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;



Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
    
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');   
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');  


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');
    Route::get('/admin/user/index', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/admin/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::put('/admin/product/{id}/update-stock', [ProductController::class, 'updateStock'])->name('admin.product.updateStock');
    Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    
});


Route::middleware(['auth', 'role:petugas'])->group(function () {

    Route::get('/dashboard-petugas', [DashboardController::class, 'dashboardPetugas'])->name('petugas.dashboard');
    
    Route::get('/petugas/product/index', [ProductController::class, 'index'])->name('petugas.product.index');
   

    
    
});