<?php

//use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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



Route::get('/', function () {
    return view('homes.clienthome');

})->name('accueil');


use App\Http\Controllers\ArticleController;

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::post('/articles/rechercher', [ArticleController::class, 'rechercher'])->name('articles.rechercher');



use App\Http\Controllers\ClientController;

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
//Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
//Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

Route::get('/clients/rechercher', [ClientController::class, 'rechercher'])->name('clients.rechercher');



use App\Http\Controllers\CommandeController;

Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
Route::get('/commandes/{commande}/edit', [CommandeController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');

Route::post('/commandes/rechercher', [CommandeController::class, 'rechercher'])->name('commandes.rechercher');

use App\Http\Controllers\LoginController;

Route::get('/loginA', [LoginController::class,'show'])->name('login.login');
Route::post('/loginA', [LoginController::class,'login'])->name('login.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeClientController;
Route::get('/articlesliste', [HomeClientController::class, 'index'])->name('articlesliste.index');
Route::get('/articlesliste/search', [HomeClientController::class, 'search'])->name('articlesliste.search');
Route::get('/homes/create', [HomeClientController::class, 'create'])->name('homes.create');
Route::post('/homes/store', [HomeClientController::class, 'store'])->name('homes.store');
Route::post('/store-commande', [HomeClientController::class, 'storecommande'])->name('storecommande');
//Route::post('/store-commande', 'HomeClientController@storecommande')->name('storecommande');
//Route::get('/mes-commandes', [HomeClientController::class, 'mesCommandes'])->name('client.commandes')->middleware('auth');
Route::get('/mes-commandes', [HomeClientController::class, 'mesCommandes'])->name('client.commandes');
Route::get('/profile', [HomeClientController::class, 'showProfile'])->name('client.profile');
Route::get('/client/profile/edit', [HomeClientController::class, 'editProfile'])->name('client.editProfile');
Route::put('/client/profile/update', [HomeClientController::class, 'updateProfile'])->name('client.updateProfile');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients',[ClientController::class, 'store'])->name('clients.store');

Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');