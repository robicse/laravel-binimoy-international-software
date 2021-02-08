<?php

namespace App\Http\Controllers\ExecutiveFour;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index(){
        $orders = Order::latest()->get();

        return view('backend.executive_four.accounts.index', compact('orders'));
    }
    public function TakePayment($id){
        $order_details = Order::find($id);

        return view('backend.executive_four.accounts.take_payment',compact('order_details'));
    }
}
