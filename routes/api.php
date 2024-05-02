<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/usersAll', [ApiController::class, 'getUsers'])->name('users.getUsers');

Route::get('/users/{id}', [ApiController::class, 'getUserById'])->name('users.getUserById');



Route::post('/login', [ApiController::class, 'login']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/upgrades', [ApiController::class, 'getAll'])->name('upgrades.getAll');





Route::get('/upgradesSort', [ApiController::class, 'listUpgradesByState'])->name('upgrades.listByState');


Route::get('/upgrades/valorandose', [ApiController::class, 'getAllValorandose'])->name('upgrades.getAllValorandose');


Route::get('/upgrades/encurso', [ApiController::class, 'getAllEnCurso'])->name('upgrades.getAllEnCurso');


Route::get('/upgrades/resuelta', [ApiController::class, 'getAllResuelta'])->name('upgrades.getAllResuelta');


Route::get('/upgrades/zona/sanitario', [ApiController::class, 'getSanitarioZone'])->name('upgrades.getSanitarioZone');


Route::get('/upgrades/zona/medicamentos', [ApiController::class, 'getMedicamentosZone'])->name('upgrades.getMedicamentosZone');


Route::get('/upgrades/zona/calidad', [ApiController::class, 'getCalidadZone'])->name('upgrades.getCalidadZone');


Route::get('/upgrades/zona/cosmeticos', [ApiController::class, 'getCosmeticosZone'])->name('upgrades.getCosmeticosZone');


Route::post('/upgrades', [ApiController::class, 'store'])->name('upgrades.store');


Route::put('/upgradesAdmin/{id}', [ApiController::class, 'updateAdmin'])->name('upgradesAdmin.update');


Route::put('/upgrades/{id}', [ApiController::class, 'update'])->name('upgrades.update');


Route::delete('/upgrades/{id}', [ApiController::class, 'destroy'])->name('upgrades.delete');



Route::get('/upgrades/search', [ApiController::class, 'listUpgradesByWord'])->name('upgrades.search');






