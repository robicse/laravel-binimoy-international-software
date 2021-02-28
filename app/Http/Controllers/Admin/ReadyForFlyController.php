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
            //->where('v_issue_date','!=', NULL)
            ->where('manpower','!=', NULL)
            //->where('manpower_date','!=', NULL)
            ->get();

       // dd($orderDetails);

        return view('backend.admin.ready-for-fly.index', compact('orderDetails'));
    }
    public function flightDateIssue(Request $request){
       // dd($request->all());
        $id = $request->order_details_id;
        //dd($id);
        $status_update = OrderDetail::find($id);
        $status_update->flight_date = $request->flight_date;
        $status_update->save();

        Toastr::success('Ready To Fly Date successfully added for Passenger', 'Success');
        return redirect()->back();
    }
    public function DateUpdate(Request $request){
       // dd($request->all());
        $id = $request->order_details_id;
        //dd($id);
        $status_update = OrderDetail::find($id);
        $status_update->flight_date = $request->flight_date;
        $status_update->update();

        Toastr::success('Ready To Fly Date successfully updated for Passenger', 'Success');
        return redirect()->back();
    }
}
