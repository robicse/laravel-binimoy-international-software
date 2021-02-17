<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakeAgentPayment extends Model
{
    public function agentDetail()
    {
        return $this->belongsTo('App\AgentDetail');
    }
}
