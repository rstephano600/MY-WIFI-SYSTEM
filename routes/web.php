<?php

use Illuminate\Support\Facades\Route;

// Home/Welcome page
Route::get('/', function () {
    return view('website.home');
})->name('home');




use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;

use App\Http\Controllers\Auth\AuthController;
// Guest routes (not authenticated)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Change Password
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    // Dashboard routes (role-based)


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    
    // API endpoints
    Route::get('/api/user', [AuthController::class, 'user'])->name('api.user');
    Route::get('/api/check-auth', [AuthController::class, 'checkAuth'])->name('api.check-auth');
});


use App\Http\Controllers\UserController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupportTicketController;

Route::middleware('auth')->group(function () {
// Optional route for toggling user status
Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
Route::resource('users', UserController::class);
Route::resource('bundles', BundleController::class);
Route::resource('subscriptions', SubscriptionController::class);
Route::resource('payments', PaymentController::class);
Route::resource('support', SupportTicketController::class);
Route::resource('logs', SystemLogController::class);


Route::get('/subscriptions/my', [SubscriptionController::class, 'my'])->name('subscriptions.my');
Route::get('/payments/my', [PaymentController::class, 'my'])->name('payments.my');
Route::get('/support/my', [SupportTicketController::class, 'my'])->name('support.my');
Route::get('/routers/my', [RouterController::class, 'my'])->name('routers.my');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');


Route::resource('routers', RouterController::class);
Route::resource('customers', CustomerController::class);
Route::get('/customers/search', [CustomerController::class, 'search'])->name('customers.search');
Route::post('/customers/{customer}/assign-router', [CustomerController::class, 'assignRouter'])->name('customers.assign-router');
Route::post('/customers/{customer}/remove-router', [CustomerController::class, 'removeRouter'])->name('customers.remove-router');


Route::resource('bundles', BundleController::class);
Route::resource('subscriptions', SubscriptionController::class);
Route::resource('payments', PaymentController::class);
Route::resource('support_tickets', SupportTicketController::class);


});

use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

use App\Http\Controllers\NotificationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
});
