<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home route for regular users
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Admin dashboard route
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.index');
    // Cars
 Route::resource('admin/car', CarsController::class, ['as' => 'admin']);

 // Locations
 Route::resource('admin/location', LocationsController::class, ['as' => 'admin']);

 // Bookings
 Route::resource('admin/booking', BookingsController::class, ['as' => 'admin']);

});

// cars (CRUD)
Route::get('admin/cars', [CarsController::class, 'index'])->name('admin.cars.index');
Route::get('admin/cars/create', [CarsController::class, 'create'])->name('admin.cars.create');
Route::post('admin/cars', [CarsController::class, 'store'])->name('admin.cars.store');
Route::get('admin/cars/{cars}/edit', [CarsController::class,'edit'])->name('admin.cars.edit');
Route::put('admin/cars/{cars}', [CarsController::class, 'update'])->name('admin.cars.update');
Route::delete('admin/cars/{cars}', [CarsController::class, 'destroy'])->name('admin.cars.destroy');

//
// locations (CRUD)
Route::get('admin/locations', [LocationsController::class, 'index'])->name('admin.location.index');
Route::get('admin/locations/create', [LocationsController::class, 'create'])->name('admin.location.create');
Route::post('admin/locations', [LocationsController::class, 'store'])->name('admin.location.store');
Route::get('admin/locations/{location}/edit', [LocationsController::class, 'edit'])->name('admin.location.edit');
Route::put('admin/locations/{location}', [LocationsController::class, 'update'])->name('admin.location.update');
Route::delete('admin/locations/{location}', [LocationsController::class, 'destroy'])->name('admin.location.destroy');

