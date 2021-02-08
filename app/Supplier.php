<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
   protected $guarded = [];

    public function passengers()
    {
        return $this->hasMany('App\PassengerDetails','supplier_id');
    }
    public function stock()
    {
        return $this->belongsTo('App\Stock','supplier_id');
    }

}
