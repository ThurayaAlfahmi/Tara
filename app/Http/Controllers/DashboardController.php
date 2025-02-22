<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    //
    public function index(){
// Check if the user is authenticated
if (Auth::check()) {
    $role = Auth::user()->role;

    // Redirect based on role
    if ($role === 'admin') {
        return view('admin.index'); // Admin dashboard
    } else {
        return view('user.index'); // User dashboard
    }
}

// If the user is not authenticated, redirect to login
return redirect()->route('login');
}



    }
    