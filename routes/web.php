<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DietPlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Models\Notification;

/*
|--------------------------------------------------------------------------
| FitCore Gym Management Web Routes
|--------------------------------------------------------------------------
*/

// Public Landing Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [PublicController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/pricing', [PublicController::class, 'pricing'])->name('pricing');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/membership/{id}/mark-paid', [AdminController::class, 'markPaid'])->name('admin.mark-paid');
        Route::get('/admin/membership/{id}/mark-unpaid', [AdminController::class, 'markUnpaid'])->name('admin.mark-unpaid');
        Route::post('/admin/membership/{id}/assign-trainer', [AdminController::class, 'assignTrainer'])->name('admin.assign-trainer');
        Route::post('/admin/user/{id}/cancel', [AdminController::class, 'cancelMembership'])->name('admin.cancel-membership');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('/notifications', function () {
            $notifications = Notification::with('member')->latest()->get();
            return view('notifications.index', compact('notifications'));
        })->name('notifications.index');
    });

    // Trainer Routes
    Route::middleware(['role:trainer'])->group(function () {
        Route::get('/trainer/dashboard', [TrainerController::class, 'dashboard'])->name('trainer.dashboard');
    });

    // Member Routes
    Route::middleware(['role:member'])->group(function () {
        Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
        Route::post('/member/pay-now', [MemberController::class, 'payNow'])->name('member.pay-now');
        Route::get('/receipt/{id}', [MemberController::class, 'receipt'])->name('receipt.download');
    });

    // Shared Member Profile View
    Route::get('/member/profile/{id?}', [MemberController::class, 'profile'])->name('member.profile');

    // Shared Diet Plans & Feed
    Route::get('/diet-plans', [DietPlanController::class, 'index'])->name('diet-plans.index');
    Route::post('/diet-plans', [DietPlanController::class, 'store'])->name('diet-plans.store');
    Route::post('/diet-plans/{id}/assign', [DietPlanController::class, 'assign'])->name('diet-plans.assign');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});
