<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\AgentDetail;
use App\Group;
use App\OrderDetail;
use App\PassengerDetails;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.admin.supplier-details.index', compact('suppliers'));
    }

    public function create()
    {
        return view('backend.admin.supplier-details.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $data = new Supplier();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->emergency_contact = $request->emergency_contact;
        $data->address = $request->address;
        $data->previous_pay = $request->previous_pay;
        $data->save();
        $insert_id = $data->id;
        $account = DB::table('accounts')->where('HeadLevel',3)->where('HeadCode', 'like', '1010301%')->Orderby('created_at', 'desc')->limit(1)->first();
        //dd($account);
        if(!empty($account)){
            $headcode=$account->HeadCode+1;
            //$p_acc = $headcode ."-".$request->name;
        }else{
            $headcode="1010301";
            //$p_acc = $headcode ."-".$request->name;
        }
        $p_acc = $request->name;

        $PHeadName = 'Account Receivable';
        $HeadLevel = 3;
        $HeadType = 'A';


        $account = new Account();
        $account->party_id      = $insert_id;
        $account->HeadCode      = $headcode;
        $account->HeadName      = $p_acc;
        $account->PHeadName     = $PHeadName;
        $account->HeadLevel     = $HeadLevel;
        $account->IsActive      = '1';
        $account->IsTransaction = '1';
        $account->IsGL          = '1';
        $account->HeadType      = $HeadType;
        $account->CreateBy      = Auth::User()->id;
        $account->UpdateBy      = Auth::User()->id;
        $account->save();

        Toastr::success('Supplier Details Successfully Added');
        return redirect()->route('admin.supplier.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('backend.admin.supplier-details.edit',compact('supplier'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $data =  Supplier::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->emergency_contact = $request->emergency_contact;
        $data->address = $request->address;
        $data->previous_pay = $request->previous_pay;
        $data->save();
        Toastr::success('Supplier Details Successfully Updated');
        return redirect()->route('admin.supplier.index');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        Toastr::success('Supplier Deleted Successfully','Success');
        return  redirect()->route("admin.supplier.index");
    }
    public function stampingPassport($id)
    {
        $orderDetails = OrderDetail::where('supplier_id',$id)->get();
        $supplierDetails = Supplier::find($id);
        return view('backend.admin.supplier-details.passport_for_stamping',compact('orderDetails','supplierDetails'));
    }
    public function AllStampingPassport()
    {
        $orderDetails = OrderDetail::latest()->get();
        return view('backend.admin.supplier-details.all_stamping_passport',compact('orderDetails'));
    }
    public function availablePassport($id)
    {
        $passengerDetails = PassengerDetails::where('supplier_id',$id)->where('status',0)->get();
        $supplierDetails = Supplier::find($id);
        return view('backend.admin.supplier-details.available_pass',compact('passengerDetails','supplierDetails'));
    }
}
