<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\UserController;


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
    return redirect()->route('login');
});
Route::get('/hola',function(){
    return view('ppp');
});
Route::get('/master',function(){
    return view('master');
});
Route::get('/register',function(){
    return redirect()->route('login');
});


Route::get('/home', [UpgradeController::class, 'dashboardData'])->name('home');
Route::get('/upgrades/filter/{zone}', [UpgradeController::class, 'filterByZone'])->name('upgrades.filterByZone');
Route::get('/my-upgrades', [UpgradeController::class, 'getMyUpgrades'])->name('my.upgrades');
Route::get('/search', [UpgradeController::class, 'search'])->name('upgrades.search');


Route::get('/search', [UserController::class, 'search'])->name('user.search');

Route::get('/analytics/user-upgrades', [UpgradeController::class, 'userUpgrades'])->name('analytics.user-upgrades');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('upgrades.index'); // Uso correcto de route() para redirigir por nombre
    })->name('dashboard');
    
    Route::resource('upgrades', UpgradeController::class);

    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/home', [UpgradeController::class, 'dashboardData'])->name('home');
    });
});


