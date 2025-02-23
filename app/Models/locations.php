<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    //
    protected $fillable = ['city', 'branch_name'];
    public function cars()
    {
        return $this->hasMany(cars::class);
    }
}
