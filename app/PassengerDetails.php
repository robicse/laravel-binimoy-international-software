<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassengerDetails extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }
}
