<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\cars;
use App\Models\locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingsController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $bookings = bookings::where('user_id', Auth::id())->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $cars = cars::all();
        $locations = locations::all();
        return view('bookings.create', compact('cars', 'locations'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'pickup_location_id' => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $total_days = strtotime($request->end_date) - strtotime($request->start_date);
        $total_days = ceil($total_days / 86400);
        $car = cars::findOrFail($request->car_id);
        $total_price = $total_days * $car->rate_per_day;

        $booking = bookings::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'pickup_location_id' => $request->pickup_location_id,
            'dropoff_location_id' => $request->dropoff_location_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $total_days,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);
        return redirect()->route('payments.create', ['bookingId' => $booking->id]);
        // return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }
    public function showBookingForm(cars $car)
    {
        return view('book-car', compact('car'));
    }

  
    public function confirmBooking(Request $request, cars $car)
    {
        // Validate the request
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Calculate total days and total price
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $totalDays = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
        $totalPrice = $totalDays * $car->daily_rate;

        // Create a new booking
        $booking = bookings::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'pickup_location_id' => $car->location_id,
            'dropoff_location_id' => $car->location_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Redirect to the payment page
        return redirect()->route('booking.summary', $booking->id);
    }
    public function showBookingSummary(bookings $booking)
{
    return view('booking-summary', compact('booking'));
}
    public function show($id)
    {
        //
        $booking = bookings::findOrFail($id);
        
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
        }

        return view('bookings.show', compact('booking'));

    }

    public function edit($id)
    {
        //
        $booking = bookings::findOrFail($id);

        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
        }

        $cars = cars::all();
        $locations = locations::all();
        return view('bookings.edit', compact('booking', 'cars', 'locations'));
    }

    public function update(Request $request, $id)
    {
        //
        $total_days = strtotime($request->end_date) - strtotime($request->start_date);
        $total_days = ceil($total_days / 86400);
        $car = cars::findOrFail($request->car_id);
        $total_price = $total_days * $car->rate_per_day;

        $booking = bookings::findOrFail($id);
        
        // Ensure the booking belongs to the current user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'Unauthorized access.');
        }

        $booking->update([
            'car_id' => $request->car_id,
            'pickup_location_id' => $request->pickup_location_id,
            'dropoff_location_id' => $request->dropoff_location_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $total_days,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        $booking->save();
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(bookings $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
        }

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully.');
    }
}

