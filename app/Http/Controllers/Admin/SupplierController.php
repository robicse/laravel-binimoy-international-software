<?php

namespace App\Http\Controllers\Admin;

use App\AgentDetail;
use App\Group;
use App\OrderDetail;
use App\PassengerDetails;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.admin.supplier-details.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.supplier-details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        Toastr::success('Supplier Details Successfully Added');
        return redirect()->route('admin.supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('backend.admin.supplier-details.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $data->save();
        Toastr::success('Supplier Details Successfully Updated');
        return redirect()->route('admin.supplier.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
