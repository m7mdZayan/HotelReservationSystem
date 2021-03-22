<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
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
    return view('admin/dashboard');
})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('checkout',[App\Http\Controllers\CheckoutController::class, 'checkout']);
Route::post('checkout',[App\Http\Controllers\CheckoutController::class, 'afterpayment'])->name('checkout.credit-card');

Route::get('/user', [HomeController::class, 'index']);