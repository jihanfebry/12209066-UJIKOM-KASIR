<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Exports\PenjualanExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
    
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');   
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');  
Route::get('/export', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return Excel::download(new PenjualanExport(), 'laporan-semua-penjualan.xlsx');
    } else {
        return Excel::download(new PenjualanExport($user->id), 'laporan-penjualan-' . $user->name . '.xlsx');
    }
})->name('penjualan.export');

Route::get('/print/{order}', [OrderController::class, 'print'])->name('order.print');

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

    Route::get('/admin/purchase/index', [OrderController::class, 'index'])->name('admin.purchase.index');
});


Route::middleware(['auth', 'role:petugas'])->group(function () {

    Route::get('/dashboard-petugas', [DashboardController::class, 'dashboardPetugas'])->name('petugas.dashboard');
    
    Route::get('/petugas/product/index', [ProductController::class, 'index'])->name('petugas.product.index');

    Route::get('/petugas/purchase/index', [OrderController::class, 'index'])->name('petugas.purchase.index');
    Route::get('/petugas/purchase/create', [OrderController::class, 'create'])->name('petugas.purchase.create');
    Route::get('/petugas/purchase/checkout', [OrderController::class, 'checkout'])->name('petugas.purchase.checkout');
    Route::post('/petugas/purchase/payment', [OrderController::class, 'store'])->name('petugas.payment.store');
    Route::post('/petugas/purchase/receipt', [OrderController::class, 'finalizeTransaction'])->name('petugas.receipt.store');
    Route::get('/petugas/receipt/{order}', [OrderController::class, 'receipt'])->name('receipt.show');
    Route::get('/petugas/member/verification', [OrderController::class, 'showVerificationForm'])->name('member.verification');
    Route::post('/petugas/member/verification', [OrderController::class, 'verifyMember'])->name('member.verify');
    Route::get('/petugas/order/verify-member', [OrderController::class, 'verifyMemberForm'])->name('order.verifyMemberForm');

   

    // Route::get('/export', function () {
    //     return Excel::download(new PenjualanExport(), 'laporan-semua-penjualan.xlsx');
    // })->name('penjualan.export');
    
    
});