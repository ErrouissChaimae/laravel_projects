<?php 
use App\Http\Controllers\PersonneAuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [PersonneAuthController::class, 'showLoginForm'])->name('personne.login');
Route::post('login', [PersonneAuthController::class, 'login']);
Route::post('logout', [PersonneAuthController::class, 'logout'])->name('personne.logout');

// Group routes that require person authentication
Route::middleware('auth:web')->group(function () {
    Route::get('dashboard', function () {
        return view('personne.dashboard');
    })->name('personne.dashboard');

    Route::get('membre-dashboard', function () {
        return view('membre.dashboard');
    })->name('membre.dashboard');
});
