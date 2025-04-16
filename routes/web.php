<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    return 'Proses login (dummy)';
})->name('login.auth');

Route::get('/logout', function () {
    return 'Logout (dummy)';
})->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/user/index', function () {
    return view('admin.user.index');
})->name('admin.user.index');

Route::get('/admin/user/create', function () {
    return view('admin.user.create');
})->name('admin.user.create');

Route::get('/admin/user/{id}/edit', function ($id) {
    return view('admin.user.edit', compact('id'));
})->name('admin.user.edit');

// PRODUCT
Route::get('/admin/product/index', function () {
    return view('admin.product.index');
})->name('admin.product.index');

Route::get('/admin/product/create', function () {
    return view('admin.product.create');
})->name('admin.product.create');

Route::get('/admin/product/{id}/edit', function ($id) {
    return view('admin.product.edit', compact('id'));
})->name('admin.product.edit');


Route::get('/admin/purchase/index', function () {
    return view('admin.purchase.index');
})->name('admin.purchase.index');




Route::get('/dashboard-petugas', function () {
    return view('petugas.dashboard');
})->name('petugas.dashboard');

Route::get('/petugas/product/index', function () {
    return view('petugas.product.index');
})->name('petugas.product.index');

Route::get('/petugas/purchase/index', function () {
    return view('petugas.purchase.index');
})->name('petugas.purchase.index');

Route::get('/petugas/purchase/create', function () {
    return view('petugas.purchase.create');
})->name('petugas.purchase.create');

Route::get('/petugas/purchase/checkout', function () {
    return 'Halaman Checkout (dummy)';
})->name('petugas.purchase.checkout');

Route::post('/petugas/purchase/payment', function () {
    return view('petugas.purchase.payment');
})->name('petugas.payment.store');

Route::post('/petugas/purchase/receipt', function () {
    return view('petugas.purchase.receipt');
})->name('petugas.receipt.store');

Route::get('/receipt/{order}', function ($order) {
    return view('petugas.purchase.receipt', compact('order'));
})->name('receipt.show');

Route::get('/member/verification', function () {
    return view('petugas.purchase.member');
})->name('member.verification');

Route::post('/member/verification', function () {
    return 'Proses Verifikasi Member (dummy)';
})->name('member.verify');

Route::get('/order/verify-member', function () {
    return view('petugas.purchase.member');
})->name('order.verifyMemberForm');


