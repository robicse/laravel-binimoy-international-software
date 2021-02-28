<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    /*public function stocks()
    {
        return $this->hasMany('App\Stock','group_id');
    }*/
    public function passengerDetail()
    {
        return $this->belongsTo('App\PassengerDetails','passenger_details_id');
    }
}
