<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VpnController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PlatformController;
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
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\SerivceLocationController;
use App\Models\Technician;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AccessControls;

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
Route::put('/booking/takeback/{task}/save', [TaskController::class, 'saveTakeBack'])->name('saveTakeBack');
Route::get('{task}/report', [TaskController::class, 'report'])->name('caseReport');
// Route::get('service-location/{locationId}/fields', [SerivceLocationController::class, 'locationDetail']);

Route::get('products', [ProductController::class, 'list'])->name('productsList');
Route::get('services', [ServiceController::class, 'list'])->name('servicesList');

Route::middleware(['auth', AccessControls::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('log', [LogController::class, 'index'])->name('log.index')->middleware('access.level:1');
    Route::resource('vpn', VpnController::class)->names('vpn');
    Route::resource('suggestion', SuggestionController::class)->names('suggestion');
    Route::resource('notification', NotificationController::class)->names('notification');
    Route::resource('platform', PlatformController::class)->names('platform');
    Route::resource('access', AccessControlController::class)->names('access')->middleware('access.level:1');
    // Route::get('case', [TaskController::class, 'create'])->name('case.create');
    // ->except(['create'])

    Route::prefix('case')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('case.index');
        Route::get('create', [TaskController::class, 'create'])->name('case.create');
        Route::post('/store', [TaskController::class, 'store'])->name('case.store');
        Route::get('{task}', [TaskController::class, 'show'])->name('case.show');
        // Route::get('{task}/edit', [TaskController::class, 'edit'])->name('case.edit');
        Route::get('{task}/edit1', [TaskController::class, 'edit1'])->name('case.edit1');
        Route::put('{task}/update', [TaskController::class, 'update'])->name('case.update');
        Route::put('{task}/status-update', [TaskController::class, 'statusUpdate'])->name('case.status-update');
        Route::delete('{task}/delete', [TaskController::class, 'destroy'])->name('case.destroy');
        Route::get('{task}/delete-media', [TaskController::class, 'destroyMedia'])->name('case.destroyMedia');
        Route::get('{task}/report', [TaskController::class, 'report'])->name('case.report');

        Route::post('{task}/item-info', [TaskController::class, 'itemInfoUpdate'])->name('case.item-info');
        Route::post('{task}/customer-info', [TaskController::class, 'customerInfoUpdate'])->name('case.customer-info');

        Route::post('{task}/payment-methods', [TaskController::class, 'paymentMethods'])->name('case.payment-methods');
        Route::post('{task}/comment', [TaskController::class, 'comment'])->name('case.comment');
        Route::put('{task}/comment/{comment_id}', [TaskController::class, 'commentUpdate'])->name('case.commentUpdate');
        Route::delete('{task}/comment/{comment_id}', [TaskController::class, 'commentDelete'])->name('case.commentDelete')->middleware('access.level:1,2,3');
        Route::delete('{task}/log/{log_id}', [TaskController::class, 'logDelete'])->name('case.logDelete')->middleware('access.level:1,2,3');
    });

    // Route::resource('case',  ::class)->names('case')->middleware('access.level:1,2,3');
    Route::resource('newsletter', NewsletterController::class)->names('newsletter')->middleware('access.level:1,2');
    Route::post('newsletter/{id}/send', [NewsletterController::class, 'send'])->name('newsletter.send');

    Route::get('settings/business', [SettingController::class, 'business'])->name('settingBusiness')->middleware('access.level:1,2');
    Route::get('settings/payment', [SettingController::class, 'payment'])->name('settingPayment')->middleware('access.level:1,2');
    Route::get('settings/email', [SettingController::class, 'email'])->name('settingEmail')->middleware('access.level:1,2');
    Route::resource('settings', SettingController::class)->names('setting')->middleware('access.level:1,2');
    Route::post('email/test', [SettingController::class, 'emailTest'])->name('email.test')->middleware('access.level:1');
    Route::resource('item', ItemController::class)->names('item')->middleware('access.level:1,2,3');

    Route::get('product/report', [ProductController::class, 'report'])->name('product.report');
    Route::resource('product', ProductController::class)->names('product')->middleware('access.level:1,2,3');
    Route::get('service/report', [ServiceController::class, 'report'])->name('service.report');
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
