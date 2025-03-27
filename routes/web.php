<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/getListeFrais', 'App\Http\Controllers\FraisController@getFraisVisiteur');

Route::get('/modifierFrais/{id}', 'App\Http\Controllers\FraisController@updateFrais');

Route::post('/validerFrais', 'App\Http\Controllers\FraisController@validateFrais');

Route::get('/ajouterFrais', 'App\Http\Controllers\FraisController@addFrais');

Route::get('/supprimerFrais/{id}','App\Http\Controllers\FraisController@removeFrais');

Route::get('/supprimerFrais/full/{id}','App\Http\Controllers\FraisController@removeFraisFull');

Route::get('/getListeFraisHF/{id}', 'App\Http\Controllers\FraisHFController@getFraisHF')->name('listeFraisHF');

Route::get('/modifierFraisHF/{idHF}', 'App\Http\Controllers\FraisHFController@updateFraisHF')->name('modifierFraisHF');

Route::post('/validerFraisHF', 'App\Http\Controllers\FraisHFController@validerFraisHF');

Route::get('/ajouterFraisHF/{id}', 'App\Http\Controllers\FraisHFController@addFraisHF');

Route::get('/supprimerFraisHF/{idHF}', 'App\Http\Controllers\FraisHFController@removeFraisHF');

Route::get('/confirmerFraisHF/{id}', 'App\Http\Controllers\FraisHFController@confirmerFraisHF');

Route::get('/findCompoMed', 'App\Http\Controllers\MedicamentController@rechercheMedicaments');

Route::post('/getCompoMed', 'App\Http\Controllers\MedicamentController@afficheCompoMed');

Route::get('/modifierCompoMed/{idMed}', 'App\Http\Controllers\MedicamentController@updateCompoMed')->name('modifierCompoMed');

Route::post('/validerCompo', 'App\Http\Controllers\MedicamentController@validateCompoMed');
