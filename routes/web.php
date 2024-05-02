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


Route::get('/principal', function () {
    return view('principal');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('upgrades.index'); // Uso correcto de route() para redirigir por nombre
    })->name('dashboard');
    Route::resource('upgrades', UpgradeController::class);
    Route::resource('users', UserController::class);

});

