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

Route::view('/', 'home')->name('page.home');

Route::get('/dashboard/{any?}', function () {
  return view('dashboard');
})->where('any', '.*')->middleware(['auth', 'verified'])->name('page.dashboard');

require __DIR__.'/auth.php';
