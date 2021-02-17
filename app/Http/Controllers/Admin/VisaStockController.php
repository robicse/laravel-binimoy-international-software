<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\GroupWiseVisa;
use App\AgentDetail;
use App\PassengerDetails;
use App\TakeAgentPayment;
use App\VisaStock;
//use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

//use Intervention\Image\Facades\Image;

class VisaStockController
{

    public function index()
    {
        $group = Group::all();
        $agent = AgentDetail::all();
        $visaStocks = VisaStock::sum('quantity');
        $visaDetails = VisaStock::latest()->get();

        //dd($visaDetails);
        return  view('backend.admin.visa_stock.index',compact('visaDetails','visaStocks','agent','group'));
    }

    public function create()
    {
        //$groups = Group::latest()->get();
        $agent = AgentDetail::all();
        return view('backend.admin.visa_stock.create',compact('agent'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
//        $this->validate($request,[
//            'agent_id' => 'required',
//        ]);
//        $this->validate($request,[
//            'agent_id'=>'required',
//        ]);
        Validator::make($request->all(), [
            'agent_id' => 'required',
        ]);
        $invoice = mt_rand(111111,999999);
        $vstock = new VisaStock();
        $vstock->invoice_id = $invoice;
        $vstock->agent_id = $request->agent_id;
        $vstock->quantity = $request->quantity;
        $vstock->per_piece_price = $request->per_piece_price;
        $vstock->total_price = $request->total_price;
        $vstock->pay_amount = $request->pay_amount;
        $vstock->due_amount = $request->due_amount;
        $vstock->date = $request->date;
        $vstock->save();
        $insert_id = $vstock->id;
        if($insert_id)
        {
            $takePayment = new TakeAgentPayment();
            $takePayment->visa_stock_id = $insert_id;
            $takePayment->agent_id = $request->agent_id;
            $takePayment->payable_amount = $request->total_price;
            $takePayment->pay_amount =$request->pay_amount;
            $takePayment->due_amount = $request->total_price - $request->pay_amount;

            $takePayment->date = date('Y-m-d');
            //dd($takePayment);
            $takePayment->save();
        }
        Toastr::success('Visa Quantity Stored Successfully','Success');
        return redirect()->route('admin.visa-stock.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
//        $groups = Group::all();
//        $suppliers = Supplier::all();

        $agent = AgentDetail::all();
        $vDetails = VisaStock::find($id);
        return view('backend.admin.visa_stock.edit', compact('vDetails','agent'));
    }


    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'agent_id' => 'required',
        ]);

        $vDetails = VisaStock::find($id);
        $vDetails->agent_id = $request->agent_id;
        $vDetails->quantity = $request->quantity;
        $vDetails->per_piece_price = $request->per_piece_price;
        $vDetails->total_price = $request->total_price;
        $vDetails->pay_amount = $request->pay_amount;
        $vDetails->due_amount = $request->due_amount;

        $vDetails->save();

        Toastr::success('Visa Quantity Stored Successfully','Success');
        return redirect()->route('admin.visa-stock.index');
    }


    public function destroy($id)
    {
        $stock =  Stock::find($id);
        $stock->delete();
        Toastr::success('Item Deleted Successfully','Success');
        return redirect()->back();
    }
    public function VisaDivided($id)
    {
        //dd($id);
        //$visaStockID = $id;
        $groupVisa = GroupWiseVisa::where('visa_stock_id',$id)->get();
        $visaStockID = $id;
        return view('backend.admin.visa_stock.visa-divided',compact('groupVisa','visaStockID'));
    }
    public function VisaDividedGroup(Request $request){

        //dd($request->all());
//        $this->validate($request,[
//            'agent_id' => 'required',
//        ]);
//        $this->validate($request,[
//            'agent_id'=>'required',
//        ]);
        Validator::make($request->all(), [
            'visa_stock_id' => 'required',
            'agent_id' => 'required',
            'group_id' => 'required',
        ]);

        $vstock = new GroupWiseVisa();
        $vstock->visa_stock_id = $request->visa_stock_id;
        $vstock->agent_id = $request->agent_id;
        $vstock->group_id = $request->group_id;
        $vstock->quantity = $request->quantity;
        $vstock->per_piece_price = $request->per_piece_price;

        $vstock->total_price = $request->quantity * $request->per_piece_price;
        $vstock->save();

        Toastr::success('Group wise Visa Quantity Stored Successfully','Success');
        return redirect()->route('admin.visa-stock.index');
    }

    public function GroupWiseVisaEdit($id){

        $agent = AgentDetail::all();
        $group = Group::all();
        $GWVisa = GroupWiseVisa::find($id);
        return view('backend.admin.visa_stock.group_wise_visa_edit', compact('GWVisa','agent','group'));
    }

    public function GroupWiseVisaUpdate(Request $request){

        //dd($request->all());

        Validator::make($request->all(), [
            'visa_stock_id' => 'required',
            'agent_id' => 'required',
            'group_id' => 'required',
        ]);

        $GWvisa = GroupWiseVisa::find($request->visa_stock_id);
        $GWvisa->agent_id = $request->agent_id;
        $GWvisa->group_id = $request->group_id;
        $GWvisa->quantity = $request->quantity;
        $GWvisa->per_piece_price = $request->per_piece_price;
        $GWvisa->total_price = $request->quantity * $request->per_piece_price;

        $GWvisa->save();

        Toastr::success('Visa Quantity Stored Successfully','Success');
        return redirect()->route('admin.visa-stock.index');
    }


}
