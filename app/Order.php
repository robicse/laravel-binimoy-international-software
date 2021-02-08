<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    /*public function stocks()
    {
        return $this->hasMany('App\Stock','group_id');
    }*/
}
