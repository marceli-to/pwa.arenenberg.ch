<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

// Route::view('/', 'home')->name('page.home');
Route::multilingual('standorte', [PageController::class, 'locations'])->name('page.locations');
Route::get('{locale?}', [PageController::class, 'home'])->name('page.home')->where('locale', implode('|', config('locales.supported')));


Route::get('/dashboard/{any?}', function () {
  return view('dashboard');
})->where('any', '.*')->middleware(['auth', 'verified'])->name('page.dashboard');

require __DIR__.'/auth.php';
