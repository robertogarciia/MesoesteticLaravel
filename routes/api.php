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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('/user/editUser/{id}', [ApiController::class, 'editUser']);


Route::get('/login', [ApiController::class, 'login']);


Route::get('/upgrades', [ApiController::class, 'getAll'])->name('upgrades.getAll');
Route::get('/upgrades/user/{userId}', [ApiController::class, 'getUpgradesByUserId']);


//TIPUS RESOURCES//CRUD

Route::post('/upgrades', [ApiController::class, 'store'])->name('upgrades.store');
Route::put('/upgrades/{id}', [ApiController::class, 'update'])->name('upgrades.update');
Route::put('/upgrades/{id}/likes', [ApiController::class, 'updateLikes']);

Route::post('/upgradeIntermedia', [ApiController::class, 'storeIntermedia'])->name('upgradeIntermedia.store');
Route::delete('/upgradeIntermedia', [ApiController::class, 'deleteUpgradeIntermedia']);

Route::get('/users/{userId}/likedUpgrades', [ApiController::class, 'getUserLikedUpgrades']);


//SORT UPGRADES, SORT PER STATE

Route::get('/upgradesSort', [ApiController::class, 'SortByStateAndZone'])->name('upgrades.SortByStateAndZone');
Route::get('/upgrades/valorandose', [ApiController::class, 'getAllValorandose'])->name('upgrades.getAllValorandose');
Route::get('/upgrades/encurso', [ApiController::class, 'getAllEnCurso'])->name('upgrades.getAllEnCurso');
Route::get('/upgrades/resuelta', [ApiController::class, 'getAllResuelta'])->name('upgrades.getAllResuelta');


//SORT UPGRADES, SORT PER ZONE

Route::get('/upgrades/zona/sanitaria', [ApiController::class, 'getSanitariaZone'])->name('upgrades.getSanitariaZone');
Route::get('/upgrades/zona/medicamentos', [ApiController::class, 'getMedicamentosZone'])->name('upgrades.getMedicamentosZone');
Route::get('/upgrades/zona/calidad', [ApiController::class, 'getCalidadZone'])->name('upgrades.getCalidadZone');
Route::get('/upgrades/zona/cosmeticos', [ApiController::class, 'getCosmeticosZone'])->name('upgrades.getCosmeticosZone');


//SORT PER USUARI, SORT PER BUSQUEDA DE PARAULA

Route::get('/upgrades/byUser', [ApiController::class, 'getAllByUser']);
Route::get('/upgrades/search', [ApiController::class, 'listUpgradesByWord'])->name('upgrades.search');


//SORT SATETE Y USUARI, ZONA Y USUARI, STATE, ZONE Y USUARI

Route::get('/upgrades/byStateAndUser', [ApiController::class, 'listUpgradesByStateAndUser']);
Route::get('/upgrades/byZoneAndUser', [ApiController::class, 'listUpgradesByZoneAndUser']);
Route::get('/upgrades/byStateAndZoneAndUser', [ApiController::class, 'listUpgradesByStateAndZoneAndUser']);






