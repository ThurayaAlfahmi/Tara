<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cars extends Model
{

    protected $fillable = [
        'name',
         'description', 
         'brand', 
         'model', 
         'year',
          'daily_rate',
           'availability', 
           'image_url', 
           'location_id',
            'car_type'
    ];
    

    //
    // protected $table = 'cars';

    public function location()
    {
        return $this->belongsTo(locations::class);
    }
    

    public function bookings()
    {
        return $this->hasMany(bookings::class, 'car_id');
    }

   

}
