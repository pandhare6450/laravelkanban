<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardListController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
	return Inertia::render('Welcome', [
		'canLogin' => Route::has('login'),
		'canRegister' => Route::has('register'),
		'laravelVersion' => Application::VERSION,
		'phpVersion' => PHP_VERSION,
	]);
});

// Define a route group with middleware and controllers
Route::get('/otp', function () {   return Inertia::render('otp'); });
Route::middleware(['auth', 'verified'])->group(function () {
	Route::controller(BoardController::class)->group(function () {
		Route::get('/boards/{board}', 'show')->name('boards.show');
		Route::put('/boards/{board}', 'update')->name('boards.update');
		Route::get('/boards', 'index')->name('boards');
		Route::post('/boards', 'store')->name('boards.store');
	});

	Route::controller(CardListController::class)->group(function () {
		Route::post('/cards/{board}/lists', 'store')->name('cardLists.store');
		Route::delete('/list/{id}/delete', 'delete')->name('list.delete');
	});
	
	Route::controller(CardController::class)->group(function () {
		Route::post('/cards_store', 'cards_store')->name('cards.store');
		Route::put('/card/{card}', 'update')->name('cards.update');
		Route::patch('/card/{card}/move', 'move')->name('cards.move');
		Route::delete('/card/{id}/delete', 'card_delete')->name('card.delete');
	});

	Route::controller(ProfileController::class)->group(function () {
		Route::get('/profile', 'edit')->name('profile.edit');
		Route::patch('/profile', 'update')->name('profile.update');
		Route::delete('/profile', 'destroy')->name('profile.destroy');
	});
});






require __DIR__ . '/auth.php';
