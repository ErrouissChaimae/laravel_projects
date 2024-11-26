<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\OeuvreController;
use App\Http\Controllers\Admin\AchatController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\EmpruntController;
use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\PersonneAuthController;
use App\Http\Controllers\homeController;

Route::get('/', [homeController::class, 'topVentes'])->name('top-ventes');
Route::get('/oeuvres', [homeController::class, 'index'])->name('index');
Route::get('/hshow/{id_livre}', [homeController::class, 'hshow'])->middleware('auth.check')->name('hshow');
Route::GET('/creat/{id}', [homeController::class, 'creat'])->name('creat');
Route::post('/acheter/{id_livre}', [homeController::class, 'acheter'])->name('acheter');
Route::get('/profile', [homeController::class, 'show'])->name('profile.show');
Route::post('/reserve/{id_oeuvre}', [homeController::class, 'reserve'])->name('reserve');
Route::get('/oeuvres', [HomeController::class, 'search'])->name('search');


Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/update/{id}', [HomeController::class, 'update'])->name('profile.update');


// Routes for Admin Authentication
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::post('personnes/search', [PersonController::class, 'search'])->name('personnes.search');
    Route::post('oeuvres/search', [OeuvreController::class, 'search'])->name('oeuvres.search');
    Route::post('/emprunts/search', [EmpruntController::class, 'search'])->name('emprunts.search');
    Route::post('/reservations/search', [EmpruntController::class, 'search'])->name('reservations.search');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::resource('personnes', PersonController::class);
        Route::resource('oeuvres', OeuvreController::class);
        Route::resource('achats', AchatController::class);
        Route::resource('reservations', ReservationController::class);
        Route::resource('emprunts', EmpruntController::class);
        Route::resource('membres', MembreController::class);
    });
});

// Routes for Person Authentication
Route::prefix('personne')->group(function () {
    Route::get('login', [PersonneAuthController::class, 'showLoginForm'])->name('personne.login');
    Route::post('login', [PersonneAuthController::class, 'login']);
    Route::post('logout', [PersonneAuthController::class, 'logout'])->name('personne.logout');
    Route::get('/register', [PersonneAuthController::class, 'showRegisterForm'])->name('personne.register');
Route::post('/register', [PersonneAuthController::class, 'register']);
Route::get('profile/search', [homeController::class, 'search'])->name('searchp');

});
Route::get('/filterByGenre', [homeController::class, 'filterByGenre'])->name('filterByGenre');
Route::get('/filter-genre', [homeController::class, 'filterByGenre'])->name('filter.genre');
