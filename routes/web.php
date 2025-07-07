<?php

use App\Http\Controllers\clientpppoe_controller;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\log_controller;
use App\Http\Controllers\login_controller;
use App\Http\Controllers\monitoring_controller;
use App\Http\Controllers\pppoe_controller;
use App\Http\Controllers\profilpppoe_controller;
use App\Http\Controllers\All_LogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [login_controller::class, 'showLoginForm'])->name('login');
Route::get('/login', function () {
    return redirect()->route('login');
});
Route::post('login', [login_controller::class, 'login'])->name('login.post');
Route::get('dashboard', [Dashboard_Controller::class, 'index'])->name('dashboard');
Route::get('pppoe/monitoring', [monitoring_controller::class, 'index'])->name('pppoe.monitoring');
Route::get('pppoe/client', [clientpppoe_controller::class, 'index'])->name('pppoe.client');
Route::get('pppoe/profil', [profilpppoe_controller::class, 'index'])->name('pppoe.profil');
Route::get('pppoe/log', [log_controller::class, 'index'])->name('pppoe.log');
Route::delete('/log/delete/{id}', [log_controller::class, 'delete'])->name('log.delete');
Route::get('/log/download', [log_controller::class, 'download'])->name('log.download');
Route::post('/log/bulk-delete', [log_controller::class, 'bulkDelete'])->name('log.bulkDelete');
Route::post('pppoe/client/store', [clientpppoe_controller::class, 'store'])->name('pppoe.client.store');
Route::delete('pppoe/monitoring/{id}', [monitoring_controller::class, 'destroy'])->name('pppoe.monitoring.destroy');
Route::post('/pppoe/active/remove', [monitoring_controller::class, 'removeActive'])->name('pppoe.active.remove');
Route::post('/pppoe/client/simpan', [clientpppoe_controller::class, 'simpanClient'])->name('pppoe.client.simpan');
Route::post('/pppoe-profile/store', [clientpppoe_controller::class, 'storeProfile'])->name('pppoe.profile.store');
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login');
    })->name('logout');
});
Route::get('/cpu-load', [Dashboard_Controller::class, 'Data_Resources']);
Route::get('/trafik-interface/{interface}', [Dashboard_Controller::class, 'getTrafik']);
Route::get('/simpan-log', [All_LogController::class, 'ambilDanSimpanLog']);
Route::get('/get-pppoe-notif', [All_LogController::class, 'ambilNotifikasi']);











