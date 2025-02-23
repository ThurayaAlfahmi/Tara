<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\locations;
use App\Models\cars;
use App\Models\bookings;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user(); // Get the authenticated user

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index'); // Admin dashboard
            }

            return view('user.index'); // Regular user dashboard
        }

        // If the user is not authenticated, redirect to login
        return redirect()->route('login');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminDashboard()
    {  $cars = cars::latest()->take(3)->get(); // Get only 3 latest cars
        $locations = locations::latest()->take(3)->get(); // Get only 3 latest locations
    
        return view('admin.index', compact('cars', 'locations'));
    
        // return view('admin.index', compact('locations', 'cars', 'bookings'));
       
    }
} 
