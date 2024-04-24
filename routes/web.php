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

Route::resource('users', UserController::class);

Route::resource('upgrades', UpgradeController::class);


Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('indexusers');


Route::get('/principal', function () {
    return view('principal');
});

Route::get('/createUpgrade', function () {
    return view('crearUpgrade');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('editupgrade');
    })->name('dashboard');
});

