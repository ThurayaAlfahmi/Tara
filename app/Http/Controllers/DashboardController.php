<?php

namespace App\Http\Controllers;

use App\Models\cars;
use App\Models\locations;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    //
    public function index(){
   
        $cars =cars::all();
        $locations = locations::all(); // Fetch all locations for the dropdown
        return view('welcome', compact('locations', 'cars'));
}


public function searchCars(Request $request)
{
    $pickupLocation = $request->input('pickup_location');
    $dropoffLocation = $request->input('dropoff_location');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Fetch available cars
    $availableCars = cars::where('location_id', $pickupLocation)
        ->where('availability', true)
        ->whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate]);
        })
        ->get();
        

    return view('available-cars', compact('availableCars'));
}

    }
    