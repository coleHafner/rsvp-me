<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Address;

class Guest extends Model
{
    public function address() {
        return $this->belongsTo('App\Address');
    }

    public function rsvp() {
        return $this->hasOne('App\Rsvp');
    }
}
