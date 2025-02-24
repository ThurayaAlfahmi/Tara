<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
  

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_method',
        'status',
    ];


    public function booking()
    {
        return $this->belongsTo(bookings::class , 'booking_id');
    }
}
