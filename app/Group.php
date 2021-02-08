<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    public function stocks()
    {
        return $this->hasMany('App\Stock','group_id');
    }
}
