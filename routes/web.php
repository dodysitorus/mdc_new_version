<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterControllerView;
use App\Http\Controllers\KlinikControllerView;
use App\Http\Controllers\LayananControllerView;
use App\Http\Controllers\PasienControllerView;
use App\Http\Controllers\AuthenticationController;
use App\Exports\PasienExport;
use App\Http\Controllers\PasienMemberControllerView;
use App\Http\Controllers\CicilanController;
use App\Http\Middleware\CheckRole;


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
    return view('welcome');
});

/*login*/
Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthenticationController::class, 'postlogin']);
Route::get('/logout',[AuthenticationController::class, 'logout']);

Route::group(['middleware'=>['auth','checkRole:Super Admin']],function (){
    //dokter
    Route::resource('dokter', DokterControllerView::class);
    //klinik
    Route::resource('klinik', KlinikControllerView::class);
    //layanan
    Route::resource('layanan',LayananControllerView::class);
    //pasien
    Route::resource('pasien',PasienControllerView::class);

    Route::resource('pasien_member', PasienMemberControllerView::class);
    Route::resource('cicilan', CicilanController::class);
    Route::get('export-csv', function () {
        return Excel::download(new PasienExport(), 'pasien.xlsx');
    });
    //user
    Route::resource('user',AuthenticationController::class);
});

Route::group(['middleware'=>['auth','checkRole:Super Admin,Admin']],function (){
    //dokter
    Route::resource('dokter', DokterControllerView::class);
    //klinik
    Route::resource('klinik', KlinikControllerView::class);
    //layanan
    Route::resource('layanan',LayananControllerView::class);
    //pasien
    Route::resource('pasien',PasienControllerView::class);
    Route::resource('pasien_member', PasienMemberControllerView::class);
    Route::resource('cicilan', CicilanController::class);
    Route::get('export-csv', function () {
        return Excel::download(new PasienExport(), 'pasien.xlsx');
    });
});
