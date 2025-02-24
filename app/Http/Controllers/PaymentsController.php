<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payments = payments::latest()->get() ;// List all payments
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($bookingId)
    {
        //
        
        $booking = bookings::findOrFail($bookingId); // Fetch booking details
        return view('payments.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        $payment = new payments();
        $payment->booking_id = $request->booking_id;
        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->status = 'pending'; // Set default status
        $payment->save();

        // Handle payment logic (e.g., integrate with PayPal or Stripe)

        return redirect()->route('payments.index')->with('success', 'Payment created successfully');
   
    }
  
    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $payment = payments::findOrFail($id); // Show a single payment
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   

     // Show the payment form (GET)
     public function showPaymentForm(bookings $booking)
     {
         return view('payment', compact('booking'));
     }
 
     // Process the payment (POST)
     public function processPayment(Request $request, bookings $booking)
     {
         // Validate the request
         $request->validate([
             'payment_method' => 'required|in:credit_card,paypal,cash',
         ]);
 
         // Create a new payment record
         payments::create([
             'booking_id' => $booking->id,
             'amount' => $booking->total_price,
             'payment_method' => $request->input('payment_method'),
             'status' => 'completed', // Or 'pending' depending on your logic
         ]);
 
         // Update the booking status
         $booking->update(['status' => 'confirmed']);
 
         // Redirect to a success page or show a success message
         return redirect()->route('payment.success')->with('success', 'Payment processed successfully!');
     }
}
