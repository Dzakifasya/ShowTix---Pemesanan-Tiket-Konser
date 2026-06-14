<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/concert/{id}', [ConcertController::class, 'detail'])->name('concert.detail');

// API Routes for AJAX
Route::get('/api/concert/{id}/ticket-categories', [ConcertController::class, 'getTicketCategories']);
Route::get('/api/concert/{id}', [ConcertController::class, 'getConcertDetails']);

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Cart Routes
Route::middleware('web')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
    Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear')->middleware('auth');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Payment Routes
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/payment/status', [PaymentController::class, 'getStatus'])->name('payment.status');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/history', [DashboardController::class, 'history'])->name('history');
    Route::get('/tickets', [DashboardController::class, 'tickets'])->name('tickets');
    Route::get('/ticket/{tiketId}/download', [DashboardController::class, 'downloadTicket'])->name('ticket.download');
});

// Payment Webhook
Route::post('/webhook/payment', [PaymentController::class, 'webhook'])->name('webhook.payment');
