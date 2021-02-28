<?php

namespace App\Http\Controllers\Admin;

use App\AgentDetail;
use App\Group;
use App\Order;
use App\OrderDetail;
use App\Supplier;
use App\VisaStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        $agentDetails = AgentDetail::latest()->get();
        $supplierDetails = Supplier::latest()->get();
        $orderDetails  = OrderDetail::latest()->get();
        $orders = Order::latest()->take(5)->get();
        $visaDetails = VisaStock::latest()->get();
        $manpower = OrderDetail::latest()
            ->where('tc','1')
            ->where('finger','1')
            ->count();
        $readyToFly = OrderDetail::latest()
            ->where('tc','1')
            ->where('finger','1')
            //->where('v_issue_date','!=', NULL)
            ->where('manpower','!=', NULL)
            ->where('manpower_date','!=', NULL)
            ->count();
        //dd($orderDetails);
        return view('backend.admin.dashboard', compact('groups','agentDetails','supplierDetails',
            'orderDetails','orders','visaDetails','manpower','readyToFly'));
    }
}
