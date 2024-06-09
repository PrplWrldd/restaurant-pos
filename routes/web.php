<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\HomeController;

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




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('checkout', CheckoutController::class);

Route::resource('menu-items', MenuItemController::class);

Route::resource('orders', OrderController::class);

Route::get('/pickup', [OrderController::class, 'userOrders'])->name('orders.userOrders');

Route::get('completed-orders', [OrderController::class, 'completed'])->name('orders.completed');

Route::put('orders/{order}/complete', [OrderController::class, 'markAsCompleted'])->name('orders.markAsCompleted'); // New route for AJAX
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/menu/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/menu', [MenuItemController::class, 'store'])->name('menu.store');

Route::get('/admin', 'AdminController@index')->middleware('auth');

//Route::get('/pickup', [PickupController::class, 'index'])->name('menu.pickup');


