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

Route::domain(env('DOMAIN_PWA'))->group(function () {
  Route::multilingual('/', [PageController::class, 'home'])->name('page.home');
  Route::multilingual('zugang', [PageController::class, 'access'])->name('page.access');
  Route::multilingual('download', [PageController::class, 'download'])->name('page.download');
  Route::multilingual('standorte/liste', [PageController::class, 'locationsList'])->name('page.locations.list');
  Route::multilingual('standorte/karte', [PageController::class, 'locationsMap'])->name('page.locations.map');
  Route::multilingual('standorte/{slug}', [PageController::class, 'location'])->name('page.locations.show');
  Route::get('offline', [PageController::class, 'offline'])->name('page.offline');
});
