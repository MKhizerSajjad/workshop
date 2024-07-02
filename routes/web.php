<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VpnController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobController;
use App\Models\Technician;
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
Route::post('/save-booking', [JobController::class, 'store'])->name('save');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('vpn', VpnController::class)->names('vpn');
    Route::resource('suggestion', SuggestionController::class)->names('suggestion');
    Route::resource('notification', NotificationController::class)->names('notification');
    Route::resource('jobs', JobController::class)->names('jobs')->middleware('access.level:1,2,3');
    Route::resource('item', ItemController::class)->names('item')->middleware('access.level:1,2,3');
    Route::resource('product', ProductController::class)->names('product')->middleware('access.level:1,2,3');
    Route::resource('service', ServiceController::class)->names('service')->middleware('access.level:1,2,3');
    Route::resource('priority', PriorityController::class)->names('priority')->middleware('access.level:1');
    Route::resource('employee', EmployeeController::class)->names('employee')->middleware('access.level:1');
    Route::resource('manager', ManagerController::class)->names('manager')->middleware('access.level:1');
    Route::resource('technician', TechnicianController::class)->names('technician')->middleware('access.level:1,2');
    Route::resource('customer', CustomerController::class)->names('customer')->middleware('access.level:1,2,3');
});
