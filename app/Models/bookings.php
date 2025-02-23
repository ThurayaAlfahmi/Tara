<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    //
    public function car()
    {
        return $this->belongsTo(cars::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(locations::class, 'pickup_location_id');
    }

    public function dropoffLocation()
    {
        return $this->belongsTo(locations::class, 'dropoff_location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(payments::class);
    }

}
