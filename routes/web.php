<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Static Pages
Route::get('/about', function () { return view('pages.about'); })->name('about');
Route::get('/privacy', function () { return view('pages.privacy'); })->name('privacy');
Route::get('/terms', function () { return view('pages.terms'); })->name('terms');
Route::get('/cookies', function () { return view('pages.cookies'); })->name('cookies');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/guidelines', function () { return view('pages.guidelines'); })->name('guidelines');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

use App\Http\Controllers\Auth\OAuthController;
Route::get('auth/{provider}/redirect', [OAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('auth/{provider}/callback', [OAuthController::class, 'callback'])->name('oauth.callback');

// Protected Routes
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.index');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::resource('profiles', \App\Http\Controllers\ProfileController::class)->only(['index', 'show', 'edit', 'update']);

    Route::get('messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{id}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{id}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

    Route::get('mentorships', [\App\Http\Controllers\MentorshipController::class, 'index'])->name('mentorship.index');
    Route::get('mentorships/{id}', [\App\Http\Controllers\MentorshipController::class, 'show'])->name('mentorship.show');
    Route::post('mentorships/request', [\App\Http\Controllers\MentorshipController::class, 'requestMentorship'])->name('mentorship.request');
    Route::post('mentorships/{id}/status', [\App\Http\Controllers\MentorshipController::class, 'updateStatus'])->name('mentorship.status');

    Route::post('mentorships/{id}/goals', [\App\Http\Controllers\GoalController::class, 'store'])->name('goals.store');
    Route::put('goals/{id}', [\App\Http\Controllers\GoalController::class, 'update'])->name('goals.update');

    Route::resource('events', \App\Http\Controllers\EventController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update']);
    Route::post('events/{id}/rsvp', [\App\Http\Controllers\EventController::class, 'rsvp'])->name('events.rsvp');

    Route::get('feed', [\App\Http\Controllers\FeedController::class, 'index'])->name('feed.index');
    Route::post('feed', [\App\Http\Controllers\FeedController::class, 'store'])->name('feed.store');

    Route::resource('jobs', \App\Http\Controllers\JobController::class)->only(['index', 'show', 'create', 'store']);
    Route::post('jobs/{id}/apply', [\App\Http\Controllers\JobController::class, 'apply'])->name('jobs.apply');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::patch('/users/{id}/toggle', [\App\Http\Controllers\AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle');
        
        Route::get('/moderation', [\App\Http\Controllers\AdminController::class, 'moderation'])->name('admin.moderation');
        Route::post('/flags/{id}/resolve', [\App\Http\Controllers\AdminController::class, 'resolveFlag'])->name('admin.flags.resolve');
    });
});
