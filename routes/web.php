<?php

use App\Http\Controllers\CardController;
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
    // this is the default route
    return view('welcome');
});


// this is the route for the form after submitting the form
Route::post('/distribute', [CardController::class, 'distributeCards'])->name('distribute.cards');