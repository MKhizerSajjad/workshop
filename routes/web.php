<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VpnController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PickupPointController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SerivceLocationController;
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

Route::get('/booking0', [TaskController::class, 'create0'])->name('bookingCreate0');
Route::get('/booking', [TaskController::class, 'create'])->name('bookingCreate');
Route::post('/save-booking', [TaskController::class, 'store'])->name('bookingSave');
Route::get('/booking/status', [TaskController::class, 'status'])->name('bookingStatus');
Route::get('/booking/status_search', [TaskController::class, 'statusSearch'])->name('bookingStatusSearch');
Route::get('/booking/takeback', [TaskController::class, 'takeBack'])->name('takeBack');
Route::get('/booking/takeback/details', [TaskController::class, 'takeBackDetails'])->name('takeBackDetails');
Route::get('{task}/invoice', [TaskController::class, 'invoice'])->name('caseInvoice');
// Route::get('service-location/{locationId}/fields', [SerivceLocationController::class, 'locationDetail']);

Route::get('products', [ProductController::class, 'list'])->name('productsList');
Route::get('services', [ServiceController::class, 'list'])->name('servicesList');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('vpn', VpnController::class)->names('vpn');
    Route::resource('suggestion', SuggestionController::class)->names('suggestion');
    Route::resource('notification', NotificationController::class)->names('notification');
    // Route::get('case', [TaskController::class, 'create'])->name('case.create');
    // ->except(['create'])

    Route::prefix('case')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('case.index');
        Route::get('create', [TaskController::class, 'create'])->name('case.create');
        Route::post('/store', [TaskController::class, 'store'])->name('case.store');
        Route::get('{task}', [TaskController::class, 'show'])->name('case.show');
        Route::get('{task}/edit', [TaskController::class, 'edit'])->name('case.edit');
        Route::get('{task}/edit1', [TaskController::class, 'edit1'])->name('case.edit1');
        Route::put('{task}/update', [TaskController::class, 'update'])->name('case.update');
        Route::put('{task}/status-update', [TaskController::class, 'statusUpdate'])->name('case.status-update');
        Route::delete('{task}/delete', [TaskController::class, 'destroy'])->name('case.destroy');
        Route::get('{task}/delete-media', [TaskController::class, 'destroyMedia'])->name('case.destroyMedia');
        Route::get('{task}/invoice', [TaskController::class, 'invoice'])->name('case.invoice');
    });

    // Route::resource('case',  ::class)->names('case')->middleware('access.level:1,2,3');
    Route::resource('settings', SettingController::class)->names('setting')->middleware('access.level:1,2');
    Route::resource('item', ItemController::class)->names('item')->middleware('access.level:1,2,3');
    Route::resource('product', ProductController::class)->names('product')->middleware('access.level:1,2,3');
    Route::resource('service', ServiceController::class)->names('service')->middleware('access.level:1,2,3');
    Route::resource('priority', PriorityController::class)->names('priority')->middleware('access.level:1');
    Route::resource('employee', EmployeeController::class)->names('employee')->middleware('access.level:1');
    Route::resource('manager', ManagerController::class)->names('manager')->middleware('access.level:1');
    Route::resource('technician', TechnicianController::class)->names('technician')->middleware('access.level:1,2');
    Route::resource('customer', CustomerController::class)->names('customer')->middleware('access.level:1,2,3');
    Route::resource('pickup-points', PickupPointController::class)->names('pickup-point')->middleware('access.level:1,2,3');
    // Route::resource('service-location', SerivceLocationController::class)->names('service-location')->middleware('access.level:1,2,3');

    Route::prefix('service-location')->group(function () {
        Route::get('/', [SerivceLocationController::class, 'index'])->name('service-location.index');
        Route::get('create', [SerivceLocationController::class, 'create'])->name('service-location.create');
        Route::post('/store', [SerivceLocationController::class, 'store'])->name('service-location.store');
        Route::get('{id}', [SerivceLocationController::class, 'show'])->name('service-location.show');
        Route::get('{id}/edit', [SerivceLocationController::class, 'edit'])->name('service-location.edit');
        Route::put('{id}/update', [SerivceLocationController::class, 'update'])->name('service-location.update');
        Route::delete('{id}/delete', [SerivceLocationController::class, 'destroy'])->name('service-location.destroy');
    });


});
