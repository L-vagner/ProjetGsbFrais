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

Route::get('/formLogin', 'App\Http\Controllers\VisiteurControlleur@getLogin');

Route::post('/login', 'App\Http\Controllers\VisiteurControlleur@signIn');

Route::get('/getLogin', 'App\Http\Controllers\VisiteurControlleur@signOut');

Route::get('/getListeFrais', 'App\Http\Controllers\FraisController@getFraisVisiteur');

Route::get('/modifierFrais/{id}', 'App\Http\Controllers\FraisController@updateFrais');

Route::post('/validerFrais', 'App\Http\Controllers\FraisController@validateFrais');

Route::get('/ajouterFrais', 'App\Http\Controllers\FraisController@addFrais');

Route::get('/supprimerFrais/{id}','App\Http\Controllers\FraisController@removeFrais');

Route::get('/supprimerFrais/full/{id}','App\Http\Controllers\FraisController@removeFraisFull');

Route::get('/getListeFraisHF/{id}', 'App\Http\Controllers\FraisHFController@getFraisHF')->name('listeFraisHF');

