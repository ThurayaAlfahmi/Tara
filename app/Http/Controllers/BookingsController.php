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
        $bookings = bookings::latest()->get();
        return view('admin.bookings.index', compact('bookings'));
        
    }

   
    public function showBookingForm(cars $car)
    {
        $locations = locations::all(); 
    return view('book-car', compact('car', 'locations'));
    }

  
    public function confirmBooking(Request $request, cars $car)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'pickup_location_id' => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
        ]);
    
        $totalDays = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date));
        $totalPrice = $totalDays * $car->daily_rate;
    
        $booking = bookings::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'pickup_location_id' => $request->pickup_location_id,
            'dropoff_location_id' => $request->dropoff_location_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);
        $booking->save();
    
        return redirect()->route('booking.summary', $booking->id);
    }
    public function showBookingSummary(bookings $booking)
{
    
    return view('booking-summary', compact('booking'));
}
public function show($id)
{
    // Find the booking by ID
    $booking = bookings::findOrFail($id);
    
    if (Auth::user()->role !== 'admin' && $booking->user_id !== Auth::id()) {
        return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
    }

    // Return the view with the booking data
    return view('admin.bookings.show', compact('booking'));
}



 
}

