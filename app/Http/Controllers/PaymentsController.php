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
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function updatePaymentStatus($paymentId)
    {
        // Find the payment record by ID
        $payment = payments::findOrFail($paymentId);
    
        // Update the payment status to 'completed'
        $payment->status = 'completed';
        $payment->save();
    
        // Optionally, update the booking status if needed
        $booking = $payment->booking; // Assuming relationship is defined
        if ($payment->status == 'completed') {
            $booking->status = 'confirmed';  // Change booking status to confirmed
            $booking->save();
        }
    
        // Redirect back to the payment list with a success message
        return redirect()->route('admin.payments.index')->with('success', 'تم تأكيد الدفع بنجاح!');
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
     
         // Handle the payment method and set the status accordingly
         $paymentStatus = 'completed';  // Default status for credit_card and paypal
     
         if ($request->input('payment_method') == 'cash') {
             $paymentStatus = 'pending';  // If payment is cash, it's pending until admin confirms
             
         }
     
         // Create a new payment record
         payments::create([
             'booking_id' => $booking->id,
             'amount' => $booking->total_price,
             'payment_method' => $request->input('payment_method'),
             'status' => $paymentStatus,
         ]);
     
         // Update the booking status based on payment
         if ($paymentStatus == 'completed') {
             // If payment is completed (not cash), confirm the booking
             $booking->update(['status' => 'confirmed']);
         }
     
         // Redirect to a success page or show a success message
         return redirect()->route('payment.success')->with('success', 'Payment processed successfully!');
     }
     
}
