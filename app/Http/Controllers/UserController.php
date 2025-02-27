<?php

namespace App\Http\Controllers;
use App\Models\bookings;
use App\Models\payments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function profile(){
    $user = Auth::user();

    $bookings = bookings::where("user_id", $user->id)->get();
    $payments = payments::whereIn("booking_id", $bookings->pluck("id"))->get();
    return view("user.profile", compact("payments","bookings"));

  }

   // Show the user profile edit form
   public function edit()
   { $user = Auth::user(); // Fetch the authenticated user
    return view('user.edit', compact('user')); // Pass the user data to the view
}
   

   // Update the user's information
   public function update($id)
   {
       $user = User::findOrFail($id);  // Find the user by ID
   
       $user->update([
           'name' => request('name'),
           'phone_number' => request('phone_number'),
       ]);
   
       return redirect()->route('profile.edit')->with('success', 'تم تحديث البيانات بنجاح');
   }
   
   
}
