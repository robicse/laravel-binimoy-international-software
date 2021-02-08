<?php

namespace App\Http\Controllers\Admin;

use App\AgentDetail;
use App\Group;
use App\Order;
use App\OrderDetail;
use App\Supplier;
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
        return view('backend.admin.dashboard', compact('groups','agentDetails','supplierDetails',
            'orderDetails','orders'));
    }
}
