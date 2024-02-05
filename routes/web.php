<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CalculateController;
use App\Http\Controllers\Front\LoginFrontController;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\KemejaController;
use App\Http\Controllers\Back\KainController;
use App\Http\Controllers\Back\UkuranController;
use App\Http\Controllers\Back\LenganController;
use App\Http\Controllers\Back\PortpolioController;
use App\Http\Controllers\Back\EstimasiController;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::resource('login', 'Front\LoginFrontController');
Route::post('user-store', [LoginFrontController::class, 'create_user'])->name('user.store');
Route::get('logout', [LoginFrontController::class, 'logout'])->name('user.logout');
Route::post('login', [LoginFrontController::class, 'login'])->name('login');

Route::group(['middleware' => ['guest']], function () {
    Route::resource('admin-login', 'Back\LoginController');
    Route::get('admin/login', [LoginController::class, 'login'])->name('admin.login');
});

Route::get('portpolio-front', [HomeController::class, 'portpolio'])->name('portpolio-front');
Route::get('portpolio-front/{id}', [HomeController::class, 'portpolio_detail'])->name('portpolio-front.detail');

Route::get('calculate', [CalculateController::class, 'index']);
Route::post('calculate-result',  [CalculateController::class, 'calculate_result'])->name('calculate.result');
Route::post('calculate-simpan',  [CalculateController::class, 'simpan'])->name('calculate.simpan');
Route::get('calculate-history/{id}',  [CalculateController::class, 'history'])->name('calculate.history');

// back (admin)
Route::resource('dashboard', 'Back\DashboardController');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::resource('kemeja', 'Back\KemejaController');
Route::resource('kain', 'Back\KainController');
Route::resource('ukuran', 'Back\UkuranController');
Route::resource('lengan', 'Back\LenganController');
Route::resource('portpolio', 'Back\PortpolioController');
Route::resource('estimasi', 'Back\EstimasiController');
Route::post('terima-tolak-show', [EstimasiController::class, 'select'])->name('estimasi.select');
Route::post('terima-tolak', [EstimasiController::class, 'terima_tolak'])->name('aksi.status');