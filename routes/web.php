<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('menu-items', MenuItemController::class);

Route::resource('orders', OrderController::class);

Route::get('completed-orders', [OrderController::class, 'completed'])->name('orders.completed');

Route::put('orders/{order}/complete', [OrderController::class, 'markAsCompleted'])->name('orders.markAsCompleted'); // New route for AJAX
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', 'AdminController@index')->middleware('auth');



