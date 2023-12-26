<?php

use App\Http\Controllers\AchatController;
use App\Http\Controllers\BanqueController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DepensevehiculeController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\MouvementController;
use App\Http\Controllers\ReglementController;
use App\Http\Controllers\SortieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name("home")->middleware("auth");
Route::resource('vehicule',VehiculeController::class)->middleware("auth");
Route::resource('reglement',ReglementController::class)->middleware("auth");
Route::resource('depensevehicule',DepensevehiculeController::class)->middleware("auth");
Route::resource('mouvement',MouvementController::class)->middleware("auth");
//Route::resource('entree',EntreeController::class)->middleware("auth");
//Route::resource('sortie',SortieController::class)->middleware("auth");
Route::resource('facture',FactureController::class)->middleware("auth");
Route::resource('depense',DepenseController::class)->middleware("auth");
Route::resource('achat',AchatController::class)->middleware("auth");
Route::resource('banque',BanqueController::class)->middleware("auth");
Route::resource('user',UserController::class)->middleware("auth");


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware("auth");;
Route::get('/create/entree', [App\Http\Controllers\MouvementController::class, 'createEntree'])->name('create.entree')->middleware("auth");;
Route::get('/create/sortie', [App\Http\Controllers\MouvementController::class, 'createSortie'])->name('create.sortie')->middleware("auth");;

Route::get('/list/entree', [App\Http\Controllers\MouvementController::class, 'listEntree'])->name('list.entree')->middleware("auth");;
Route::get('/list/sortie', [App\Http\Controllers\MouvementController::class, 'listSortie'])->name('list.sortie')->middleware("auth");;
Route::post('/between/date/mouvement', [App\Http\Controllers\MouvementController::class, 'getBetweenToDate'])->name('betwween.date')->middleware("auth");;
Route::get('/creance', [App\Http\Controllers\ReglementController::class, 'detteClient'])->name('creance')->middleware("auth");;
Route::get('/factures/{id}', [App\Http\Controllers\VehiculeController::class, 'facture'])->name('facture')->middleware("auth");;

Route::get('/depense/vehicule/{id}', [App\Http\Controllers\DepensevehiculeController::class, 'depenseVehicule'])->name('depense.vehicule')->middleware("auth");;
Route::get('/factures/by/vehicule/{id}', [App\Http\Controllers\FactureController::class, 'getFactureByVehicule'])->name('facture.by.vehicule')->middleware("auth");;
Route::post('/importer/banque', [App\Http\Controllers\BanqueController::class, 'importBanque'])->name('importer.banque')->middleware("auth");;

Route::post('/between/date/achat', [App\Http\Controllers\AchatController::class, 'getBetweenToDate'])->name('betwween.date.achat')->middleware("auth");;
