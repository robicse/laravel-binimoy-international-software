<?php


namespace App\Http\Controllers\Admin;

use App\OrderDetail;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ReadyForFlyController
{
    public function index()
    {
        $orderDetails = OrderDetail::latest()
            ->where('tc','1')
            ->where('finger','1')
            ->where('v_issue_date','!=', NULL)
            ->where('manpower','!=', NULL)
            ->where('manpower_date','!=', NULL)
            ->get();

        return view('backend.admin.ready-for-fly.index', compact('orderDetails'));
    }
}
