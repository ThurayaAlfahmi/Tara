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
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'index'])->name('welcome');


Auth::routes();

// Home route for regular users
Route::get('/home', [DashboardController::class, 'index'])->name('home');


Route::get('/admin', [DashboardController::class, 'index'])->name('admindashboard');


// Admin dashboard route
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.index');
    // Cars
 Route::resource('admin/car', CarsController::class, ['as' => 'admin']);
 Route::get('admin/cars', [CarsController::class, 'index'])->name('admin.cars.index');
 Route::get('admin/cars/create', [CarsController::class, 'create'])->name('admin.cars.create');
Route::post('admin/cars', [CarsController::class, 'store'])->name('admin.cars.store');
Route::get('admin/cars/{cars}/edit', [CarsController::class,'edit'])->name('admin.cars.edit');
Route::put('admin/cars/{cars}', [CarsController::class, 'update'])->name('admin.cars.update');
Route::delete('admin/cars/{cars}', [CarsController::class, 'destroy'])->name('admin.cars.destroy');

 // Locations
 Route::resource('admin/location', LocationsController::class, ['as' => 'admin']);
Route::get('admin/locations', [LocationsController::class, 'index'])->name('admin.location.index');
Route::get('admin/locations/create', [LocationsController::class, 'create'])->name('admin.location.create');
Route::post('admin/locations', [LocationsController::class, 'store'])->name('admin.location.store');
Route::get('admin/locations/{location}/edit', [LocationsController::class, 'edit'])->name('admin.location.edit');
Route::put('admin/locations/{location}', [LocationsController::class, 'update'])->name('admin.location.update');
Route::delete('admin/locations/{location}', [LocationsController::class, 'destroy'])->name('admin.location.destroy');

 // Bookings
 Route::resource('admin/booking', BookingsController::class, ['as' => 'admin']);
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings.index');
Route::get('/bookings/{id}', [BookingsController::class, 'show'])->name('bookings.show');

//
 
//payments
Route::get('/admin/payments', [PaymentsController::class, 'index'])->name('admin.payments.index');
Route::patch('admin/payments/{paymentId}', [PaymentsController::class, 'updatePaymentStatus'])->name('admin.update.payment');
});







//user

Route::middleware(['auth'])->group(function () {
Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');  
Route::get('/search-cars', [DashboardController::class, 'searchCars'])->name('search.cars');
Route::get('/book-car/{car}', [BookingsController::class, 'showBookingForm'])->name('book.car')->middleware('auth');
Route::post('/confirm-booking/{car}', [BookingsController::class, 'confirmBooking'])->name('confirm.booking')->middleware('auth');
Route::post('/payment/{booking}', [PaymentsController::class, 'showPaymentForm'])->name('payment.form')->middleware('auth');
Route::get('/booking-summary/{booking}', [BookingsController::class, 'showBookingSummary'])->name('booking.summary');
Route::get('/payment/{booking}', [PaymentsController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/process-payment/{booking}', [PaymentsController::class, 'processPayment'])->name('process.payment');
Route::get('/payment-success', function () {
    return view('payment-success');
})->name('payment.success');
 Route::get('/dashboard', [UserController::class, 'profile'])->middleware('auth')->name('profile');
 Route::get('/user/cars', [CarsController::class, 'showCars'])->name('user.cars');
});

