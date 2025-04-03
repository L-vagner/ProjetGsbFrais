<?php

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

Route::get('/findCompoMed', 'App\Http\Controllers\MedicamentController@rechercheMedicaments');

Route::post('/getCompoMed', 'App\Http\Controllers\MedicamentController@afficheCompoMed');

Route::get('/modifierCompoMed/{idMed}', 'App\Http\Controllers\MedicamentController@updateCompoMed')->name('modifierCompoMed');

Route::post('/validerCompo', 'App\Http\Controllers\MedicamentController@validateCompoMed');

Route::get('/ajouterCompoMed/{idMed}', 'App\Http\Controllers\MedicamentController@addCompoMed')->name('ajouterCompoMed');

Route::get('/supprimerCompoMed/{idMed}/{idCompo}', [MedicamentController::class, 'removeCompoMed'])->name('supprimerCompoMed');
