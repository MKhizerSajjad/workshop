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

Route::get('/', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Auth::routes();
Route::get('category/add', [App\Http\Controllers\CategoryController::class, 'category'])->name('category.add');
Route::post('category/new', [App\Http\Controllers\CategoryController::class, 'new'])->name('category.new');
Route::get('category/list', [App\Http\Controllers\CategoryController::class, 'list'])->name('category.list');
Route::get('category/{categoryId}/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
Route::get('category/{categoryId}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/{categoryId}/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::get('product/add', [App\Http\Controllers\ProductController::class, 'add'])->name('product.add');
Route::post('product/new', [App\Http\Controllers\ProductController::class, 'new'])->name('product.new');
Route::get('product/list', [App\Http\Controllers\ProductController::class, 'list'])->name('product.list');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
