<?php

use App\Http\Controllers\{
    AdminController, AutocarController, Auth\LoginController, Auth\RegisterController, HomeController, TicketController, WelcomeC ,ProfileController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//commendes
use App\Http\Controllers\CommandeController;

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/create/{id}', [CommandeController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::delete('/commandes/{id_commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
});
//welcome
Route::get('/', [WelcomeC::class, 'index']);
Route::get('/search1', [WelcomeC::class, 'search1'])->name('search1');
Route::get('/filterTickets', [WelcomeC::class, 'filterTickets'])->name('filterTickets');

// routes/web.php

Auth::routes();

// Routes pour les clients
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/edit',[ProfileController::class, 'edit'])->name('home');
    Route::put('/profile/update',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
});

// Routes d'inscription et de connexion pour les clients
Route::get('register/client', [RegisterController::class, 'showClientRegistrationForm'])->name('register.client');
Route::post('register/client', [RegisterController::class, 'registerClient']);
Route::get('login/client', [LoginController::class, 'showClientLoginForm'])->name('login.client');
Route::post('login/client', [LoginController::class, 'clientLogin']);

// Routes pour les administrateurs
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/dashboard/search', [AdminController::class, 'search'])->name('dashboard.search');
    // Commandes
    Route::get('/commandes/all', [CommandeController::class, 'all'])->name('commandes.all');
    Route::delete('/commandes/past/{id}', [CommandeController::class, 'deletePastOrder'])->name('commandes.deletePast');
    Route::get('/all/search', [CommandeController::class, 'search'])->name('all.search');
    // Autocars
    Route::get('/autocars', [AutocarController::class, 'index'])->name('autocars.index');
    Route::get('/autocars/create', [AutocarController::class, 'create'])->name('autocars.create');
    Route::post('/autocars', [AutocarController::class, 'store'])->name('autocars.store');
    Route::get('/autocars/{id}/edit', [AutocarController::class, 'edit'])->name('autocars.edit');
    Route::put('/autocars/{id}', [AutocarController::class, 'update'])->name('autocars.update');
    Route::delete('/autocars/{id}', [AutocarController::class, 'destroy'])->name('autocars.destroy');
    Route::get('/autocars/search', [AutocarController::class, 'search'])->name('autocar.search');
    // Tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
});

// Routes d'inscription et de connexion pour les administrateurs
Route::get('register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('register.admin');
Route::post('register/admin', [RegisterController::class, 'registerAdmin']);
Route::get('login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('login/admin', [LoginController::class, 'adminLogin']);
