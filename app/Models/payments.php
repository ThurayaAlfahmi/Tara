<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    //
    public function booking()
    {
        return $this->belongsTo(bookings::class);
    }
}
