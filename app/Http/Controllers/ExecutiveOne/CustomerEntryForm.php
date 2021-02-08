<?php

namespace App\Http\Controllers\ExecutiveOne;

use App\AgentDetail;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerEntryForm extends Controller
{
    public function getEntryForm()
    {
        $groups = Group::all();
        $agents = AgentDetail::all();
        return view('backend.executive_one.customer_entry_form', compact('groups','agents'));
    }
}
