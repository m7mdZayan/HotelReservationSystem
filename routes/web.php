<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\FloorsController;

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
    // auth()->user()->assignRole('user');
    // auth()->user()->assignRole('manager');
    auth()->user()->assignRole('admin');
    //  auth()->user()->assignRole('receptionist');

    //dd(auth()->guard()->user());
    return view('admin.index');
})->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Route::get('/user', [HomeController::class, 'index']);

//Route::get('/users', [App\Http\Controllers\HomeController::class, 'index'])->name('users.index');
// Route::get('/users', [App\Http\Controllers\HomeController::class, 'index'])->name('users.index');

//dashBoards Routes
//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin/managers', [AdminController::class, 'manage_managers'])->name('admin.managers')->middleware('auth');
Route::get('/admin/receptionists', [AdminController::class, 'manage_receptionists'])->name('admin.receptionists')->middleware('auth');
Route::get('/admin/client', [AdminController::class, 'manage_client'])->name('admin.client')->middleware('auth');


//manager
//Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index')->middleware('auth');
Route::get('/manager/receptionists',[ManagerController::class, 'manage_receptionists'])->name('manager.receptionists')->middleware('auth');
Route::get('/manager/floors',[floorsController::class, 'index'])->name('manager.floors')->middleware('auth');
Route::get('/manager/rooms',[RoomsController::class, 'index'])->name('manager.rooms')->middleware('auth');

//receptionist
//Route::get('/receptionist', [ReceptionistController::class, 'index'])->name('receptionist.index')->middleware('auth');
Route::get('/receptionist/show', [ReceptionistController::class, 'show'])->name('receptionist.show')->middleware('auth');
Route::get('/receptionist/manage', [ReceptionistController::class, 'manage_client'])->name('receptionist.client')->middleware('auth');
Route::get('/receptionist/approved', [ReceptionistController::class, 'show_reservations'])->name('receptionist.approved')->middleware('auth');

//client
//Route::get('/client', [ClientController::class, 'index'])->name('client.index')->middleware('auth');
Route::get('/client/create', [ClientController::class, 'make_reservation'])->name('client.make_reservation')->middleware('auth');
Route::get('/client/show', [ClientController::class, 'my_reservation'])->name('client.my_reservation')->middleware('auth');
Route::get('checkout',[CheckoutController::class, 'checkout'])->name('client.checkout');
Route::post('checkout',[CheckoutController::class, 'after_payment'])->name('checkout.credit-card');

