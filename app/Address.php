<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // public function guest() {
    //     return $this->belongsTo('App\Guest');
    // }

    public function __toString() {
        return $this->street . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip;
    }
}
