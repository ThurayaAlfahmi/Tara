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

Route::get('/', [DashboardController::class, 'index'])->name('welcome');


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

//bookings
// Display all bookings for the authenticated user
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create', [BookingsController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingsController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{id}', [BookingsController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{id}/edit', [BookingsController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{id}', [BookingsController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{booking}', [BookingsController::class, 'destroy'])->name('bookings.destroy');


//payments
// Payment routes
Route::get('payments/create/{bookingId}', [PaymentsController::class, 'create'])->name('payments.create');
Route::post('payments', [PaymentsController::class, 'store'])->name('payments.store');
Route::get('payments/{id}', [PaymentsController::class, 'show'])->name('payments.show');

//user

Route::get('/search-cars', [DashboardController::class, 'searchCars'])->name('search.cars');
Route::get('/book-car/{car}', [BookingsController::class, 'showBookingForm'])->name('book.car')->middleware('auth');
Route::post('/confirm-booking/{car}', [BookingsController::class, 'confirmBooking'])->name('confirm.booking')->middleware('auth');
Route::post('/payment/{booking}', [PaymentsController::class, 'showPaymentForm'])->name('payment.form')->middleware('auth');
Route::post('/submit-review/{car}', [ReviewsController::class, 'submitReview'])->name('submit.review')->middleware('auth');
Route::get('/booking-summary/{booking}', [BookingsController::class, 'showBookingSummary'])->name('booking.summary');
Route::get('/payment/{booking}', [PaymentsController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/process-payment/{booking}', [PaymentsController::class, 'processPayment'])->name('process.payment');
Route::get('/payment-success', function () {
    return view('payment-success');
})->name('payment.success');