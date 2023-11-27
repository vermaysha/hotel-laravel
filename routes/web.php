<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FOController;
use App\Http\Controllers\GMController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SMController;


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
// Route::get('/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin']);
    Route::resource(
        '/customer',
        \App\Http\Controllers\CustomerController::class
    );

});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});

// untuk admin
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::resource(
        '/kamar',
        \App\Http\Controllers\KamarController::class
    );
});

// untuk sm
Route::group(['middleware' => ['auth', 'checkrole:2']], function () {
    Route::get('/sm', [SMController::class, 'index']);

    Route::resource(
        '/tarif',
        \App\Http\Controllers\TarifController::class
    );
    Route::resource(
        '/season',
        \App\Http\Controllers\SeasonController::class
    );
    Route::resource(
        '/layanan_kamar',
        \App\Http\Controllers\LayananKamarController::class
    );

    Route::resource(
        '/customer',
        \App\Http\Controllers\CustomerController::class
    );
});

// Untuk FO
Route::group(['middleware' => ['auth', 'checkrole:6']], function () {
    Route::get('/fo', [FOController::class, 'index'])->name('fo.index');
    Route::get('/fo/history', [FOController::class, 'history'])->name('fo.history');
    Route::get('/fo/checkin/{id}', [FOController::class, 'checkin'])->name('fo.checkin')->whereNumber('id');
    Route::post('/fo/checkin/{id}', [FOController::class, 'checkinProcess'])->name('fo.checkin')->whereNumber('id');
    Route::get('/fo/checkout/{id}', [FOController::class, 'checkout'])->name('fo.checkout')->whereNumber('id');
    Route::post('/fo/checkout/{id}', [FOController::class, 'checkoutProcess'])->name('fo.checkout')->whereNumber('id');
    Route::get('/fo/print-nota/{id}', [FOController::class, 'printNota'])->name('fo.print-nota')->whereNumber('id');
});

// Untuk GM
Route::group(['middleware' => ['auth', 'checkrole:3,4']], function () {
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/new-cust', [ReportController::class, 'newCust'])->name('report.newCust');
    Route::get('/report/pendapatan', [ReportController::class, 'pendapatan'])->name('report.pendapatan');
    Route::get('/report/jumlahTamu', [ReportController::class, 'jumlahTamu'])->name('report.jumlahTamu');
    Route::get('/report/bestOfFive', [ReportController::class, 'bestOfFive'])->name('report.bestOfFive');
});

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});


Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About"
    ]);
});

Route::get('/posts', function () {
    return view('posts', [
        "title" => "Posts"
    ]);
});
