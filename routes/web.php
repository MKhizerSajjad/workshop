<?php

use App\Http\Controllers\VpnController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::view('admin', 'Admin');
// Auth::routes();


// Route::middleware(['auth'])->group(function () {
//     Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
//     Route::resource('vpn', VpnController::class)->names('vpn');
//     Route::resource('suggestion', SuggestionController::class)->names('suggestion');
//     Route::resource('notification', NotificationController::class)->names('notification');

//     Route::get('/ai-tools', function () {
//         return view('ai-tools');
//     })->name('ai-tools');

//     Route::get('/tools', function () {
//         return view('tools.index');
//     })->name('tools');
// });
