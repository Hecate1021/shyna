<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\OfficeDashboardController;
use App\Http\Controllers\OfficeUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', fn() => view('auth.login'));

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // User-Specific Routes


    // Office-Specific Routes
    Route::middleware(RoleMiddleware::class . ':office')->group(function () {
        Route::get('/office/dashboard', [OfficeDashboardController::class, 'index'])->name('office.dashboard');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    });

    // Admin-Specific Routes
    Route::middleware(RoleMiddleware::class . ':admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/accounts', [AdminDashboardController::class, 'accountFaculty'])->name('admin.accout.faculty');
        Route::get('/accountlist', [AdminDashboardController::class, 'accountList'])->name('admin.account.list');
        Route::get('/announcement', [AnnouncementController::class, 'viewAllAnnouncements'])->name('admin.announcement');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('admin.announcements.store');
        Route::resource('school_year', App\Http\Controllers\SchoolYearController::class);

        Route::post('/office-users', [OfficeUserController::class, 'store'])->name('office.users.store');
        Route::get('/office-users', [OfficeUserController::class, 'index'])->name('office.users.index');
        Route::put('/{id}/update', [OfficeUserController::class, 'update'])->name('office.users.update');

        Route::delete('/office-users/{user}', [OfficeUserController::class, 'destroy'])->name('office.users.destroy');
    });
});

// Socialite Routes
Route::prefix('auth')->group(function () {
    Route::get('/google', [SocialiteController::class, 'googleLogin'])->name('auth.google');
    Route::get('/google-callback', [SocialiteController::class, 'googleCallback'])->name('auth.google-callback');
});

// User Profile Completion Routes
Route::prefix('user/profile')->group(function () {
    Route::get('/fill', [SocialiteController::class, 'showProfileForm'])->name('user.profile.fill');
    Route::post('/save', [SocialiteController::class, 'saveProfileData'])->name('user.profile.save');
});

// Include Auth Routes
require __DIR__ . '/auth.php';
