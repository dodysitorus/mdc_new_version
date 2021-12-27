<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterControllerJson;
use App\Http\Controllers\KlinikControllerJson;
use App\Http\Controllers\LayananControllerJson;
use App\Http\Controllers\PasienController;
use \App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PasienMemberControllerJSON;
use \App\Http\Controllers\CicilanController;
use App\Http\Controllers\PengeluaranCicilanController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//dokter
Route::resource('/dokter',DokterControllerJson::class);

//klinik
Route::resource('/klinik', KlinikControllerJson::class);

//layanan
Route::resource('/layanan',LayananControllerJson::class);

//  pasien
Route::resource('/pasien', PasienController::class);

Route::post('/loginMobile', [AuthenticationController::class,'loginMobile']);

Route::post('/addUser', [AuthenticationController::class,'store']);

Route::post('/addPasienMember',[PasienMemberControllerJSON::class,'store']);

Route::post('/add-cicilan',[CicilanController::class, 'store']);

Route::post('/bayar',[PengeluaranCicilanController::class, 'store']);

Route::get('/pasien-member',[PasienMemberControllerJSON::class, 'index']);
Route::post('/pasien-detail',[PasienMemberControllerJSON::class, 'memberPayment']);

Route::post("/filter", [PasienMemberControllerJSON::class, 'filter']);

Route::post("/filter-pasien",[PasienController::class,'filter']);
