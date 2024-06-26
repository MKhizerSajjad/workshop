<?php

use App\Http\Controllers\VpnController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobController;
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

Auth::routes();

Route::get('/booking', [JobController::class, 'create'])->name('create');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('vpn', VpnController::class)->names('vpn');
    Route::resource('suggestion', SuggestionController::class)->names('suggestion');
    Route::resource('notification', NotificationController::class)->names('notification');
    Route::resource('item', ItemController::class)->names('item');
    Route::resource('product', ProductController::class)->names('product');
    Route::resource('service', ServiceController::class)->names('service');
    Route::resource('employee', EmployeeController::class)->names('employee');
    Route::resource('customer', CustomerController::class)->names('customer');

    Route::get('/ai-tools', function () {
        return view('ai-tools');
    })->name('ai-tools');

    Route::get('/tools', function () {
        return view('tools.index');
    })->name('tools');
});
