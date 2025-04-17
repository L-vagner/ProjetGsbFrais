<?php

use App\Http\Controllers\RapportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('home');
});

Route::get('/formLogin', 'App\Http\Controllers\VisiteurController@getLogin');

Route::post('/login', 'App\Http\Controllers\VisiteurController@signIn');

Route::get('/getLogin', 'App\Http\Controllers\VisiteurController@signOut');

Route::get('/findCompoMed', [MedicamentController::class, 'rechercheMedicaments']);

Route::get('/getCompoMed', [MedicamentController::class, 'afficheCompoMed']);

Route::get('/modifierCompoMed/{idMed}', [MedicamentController::class, 'updateCompoMed'])->name('modifierCompoMed');

Route::post('/validerCompo', [MedicamentController::class, 'validateCompoMed']);

Route::get('/ajouterCompoMed/{idMed}', [MedicamentController::class, 'addCompoMed'])->name('ajouterCompoMed');

Route::get('/supprimerCompoMed/{idMed}/{idCompo}', [MedicamentController::class, 'removeCompoMed'])->name('supprimerCompoMed');

Route::get('/getMedicaments', [MedicamentController::class, 'getMedicaments']);

Route::get('/formFamille', [MedicamentController::class, 'rechercheFamille']);

Route::get('/getFamille', [MedicamentController::class, 'afficheMedParFam'])->name('medocParFamille');

Route::get('/getRapport', [RapportController::class, 'afficheRapport']);

Route::get('/findRapport', [RapportController::class, 'rechercheRapport']);

Route::get('/addRapport', [RapportController::class, 'addRapport'])->name("ajouterRapport");

Route::get('/updateRapport/{idRapp}', [RapportController::class, 'updateRapport'])->name('updateRapport');

Route::post('/validerRapport', [RapportController::class, 'validateRapport']);

Route::get('/viewMedicamentOffert/{idRapp}', [RapportController::class, 'afficheMedocOffert']);

Route::get('/addMedocOffert/{idRap}', [RapportController::class, 'addMedocOffert'])->name('addMedocOffert');

Route::post('/validerMedocOffert', [RapportController::class, 'validateMedocOffert']);

Route::get('/supprimerMedocOffert/{idRap}/{idMed}', [RapportController::class, 'removeMedocOffert']);
