<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ReceptionistController;

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
    //auth()->guard()->user()->assignRole('admin');
    auth()->user()->assignRole('user');
    //dd(auth()->guard()->user());
    return view('admin/index');
})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('checkout',[App\Http\Controllers\CheckoutController::class, 'checkout']);
Route::post('checkout',[App\Http\Controllers\CheckoutController::class, 'afterpayment'])->name('checkout.credit-card');

// Route::get('/user', [HomeController::class, 'index']);

// Route::get('/users', [App\Http\Controllers\HomeController::class, 'index'])->name('users.index');
//dashBoards Routes
//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
//manager
Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index')->middleware('auth');

Route::get('/manager/floors',[ManagerController::class, 'show'])->name('manager.floors')->middleware('auth');

Route::get('/manager/rooms',[ManagerController::class, 'showrooms'])->name('manager.rooms')->middleware('auth');

//receptionist
Route::get('/receptionist', [ReceptionistController::class, 'index'])->name('receptionist.index')->middleware('auth');
//client
Route::get('/client', [ClientController::class, 'index'])->name('client.index')->middleware('auth');
