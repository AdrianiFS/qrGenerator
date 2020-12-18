<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\QrgeneratorController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//qr routes
Route::get('/qrpages/index', [QrgeneratorController::class, 'index'])->name('qrpages.index');

Route::get('/qrpages', [QrgeneratorController::class, 'queryString']);

Route::get('/qrpages/qrform', [QrgeneratorController::class, 'qrform'])->name('qrpages.qrform');

Route::post('/qrpages/store', [QrgeneratorController::class, 'store'])->name('qrpages.store');

// Route::get('/qrpages/create', [QrgeneratorController::class, 'create'])->name('qrpages.create');

// Route::get('/qrpages/{qrgenerator}', [QrgeneratorController::class, 'show'])->name('qrpages.show');

// Route::post('/qrpages/updateAndStore/', [QrgeneratorController::class, 'updateAndStore'])->name('qrpages.updateAndStore');
Route::post('/qrpages', [QrgeneratorController::class, 'gettingValues']);
