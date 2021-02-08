<?php

namespace App\Http\Controllers\ExecutiveFour;

use App\OrderDetail;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ReadyForFlyController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::latest()
            ->where('tc','1')
            ->where('finger','1')
            ->where('v_issue_date','!=', NULL)
            ->where('visa_no','!=', NULL)
            ->where('id_number','!=', NULL)
            ->get();

        return view('backend.executive_four.ready-for-fly.index', compact('orderDetails'));
    }
}
