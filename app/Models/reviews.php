<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    //
    public function car()
    {
        return $this->belongsTo(cars::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
