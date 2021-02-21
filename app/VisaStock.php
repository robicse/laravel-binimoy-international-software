<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaStock extends Model
{
    protected $guarded = [];

    /*public function group()
    {
        return $this->belongsTo('App\Group','group_id');
    }*/
    public function agent()
    {
        return $this->belongsTo('App\AgentDetail','agent_id');
    }
}
