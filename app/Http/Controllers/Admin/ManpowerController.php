<?php

namespace App\Http\Controllers\Admin;

use App\OrderDetail;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ManpowerController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::latest()
            ->where('tc','1')
            ->where('finger','1')
            ->get();

        return view('backend.admin.manpower.index', compact('orderDetails'));
    }

    public function visaIssue(Request $request){

          //dd($request->all());
        $id = $request->order_details_id;
        //dd($id);
        $status_update = OrderDetail::find($id);
        $status_update->v_issue_date = $request->v_issue_date;
        $status_update->save();

        Toastr::success('Visa Issue successfully added for Passenger', 'Success');
        return redirect()->route('admin.manpower.index');
    }

    public function orderTcChange(Request $request, $id)
    {
        //dd($request->all());
        $tc_id = Input::get('tc');
        $finger_id = Input::get('finger');

        if ($tc_id == '') {
            $check_tc = OrderDetail::find($id);
            $tc_id = $check_tc->tc;
        } elseif ($finger_id == '') {
            $check_finger = OrderDetail::find($id);
            $finger_id = $check_finger->finger;
        }
        //dd($finger_id);
        $status_update = OrderDetail::find($id);
        $status_update->tc = $tc_id;
        $status_update->finger = $finger_id;
        $status_update->save();

        Toastr::success('TC And Finger successfully added for visa', 'Success');
        return redirect()->route('admin.training_card.index');
    }
    public function statusIssue(Request $request){
        //dd($request->all());
        $id = $request->order_details_id;
        //dd($id);
        $status_update = OrderDetail::find($id);
        $status_update->manpower = $request->manpower;
        $status_update->manpower_date = $request->manpower_date;
        $status_update->save();

        Toastr::success('Manpower Issue successfully added for Passenger', 'Success');
        return redirect()->route('admin.manpower.index');
    }

}
