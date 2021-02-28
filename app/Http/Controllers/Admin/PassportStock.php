<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\PassengerDetails;
use App\Stock;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PassportStock extends Controller
{
    public function index()
    {
        $passportStocks = Stock::sum('quantity');
        $passengerDetails = PassengerDetails::latest()->get();
        //dd($passengerDetails);
        return  view('backend.admin.passport_stock.index',compact('passengerDetails','passportStocks'));
    }
    public function create()
    {
        $groups = Group::latest()->get();
        $suppliers = Supplier::all();
        return view('backend.admin.passport_stock.create',compact('groups','suppliers'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'supplier_id' => 'required',
            //'pp_img' => 'required',
            //'pp_img.*' => 'image|mimes:jpg,jpeg'
           // 'pp_img' =>'required|mimes:jpeg,jpg,png',
        ]);

        $row_count = count($request->passenger_name);
        //dd($row_count);
        for ($i = 0; $i < $row_count; $i++) {
            $pDetails = new PassengerDetails();
            $pDetails->passenger_name = $request->passenger_name[$i];
            $pDetails->group_id = $request->group_id[$i];
            $pDetails->pp_no = $request->pp_no[$i];
            //$pDetails->pp_img = $request->pp_img[$i];
            $pDetails->supplier_id = $request->supplier_id;

            $image = $request->pp_img[$i];
            if (isset($image)) {//make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for category and upload
                $pImage = Image::make($image)->resize(720, 1080)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/passport/' . $imagename, $pImage);
            } else {
                $imagename = 'default.png';
            }
            $pDetails->pp_img = $imagename;
            $pDetails->save();
        }
        $stockCheck = Stock::where('supplier_id',$request->supplier_id)->first();
        if (empty($stockCheck)){
            $stock = new Stock();
            $stock->supplier_id = $request->supplier_id;
            $stock->quantity = $row_count;
            $stock->save();
        }else{
            $stock = Stock::where('supplier_id',$request->supplier_id)->first();
            $stock->supplier_id = $request->supplier_id;
            $stock->quantity += $row_count;
            $stock->save();
        }
        Toastr::success('Item Stored Successfully','Success');
        return redirect()->route('admin.passport-stock.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
//        $groups = Group::all();
//        $suppliers = Supplier::all();
//        $stock = Stock::find($id);
        $pDetails = PassengerDetails::find($id);
        return view('backend.admin.passport_stock.edit', compact('pDetails'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'passenger_name' => 'required',
            'pp_no' => 'required',
        ]);

        $pDetails = PassengerDetails::find($id);
        $pDetails->passenger_name = $request->passenger_name;
        $pDetails->pp_no = $request->pp_no;
        $image = $request->file('pp_img');
        //dd($image);
        if (isset($image)) {//make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if(Storage::disk('public')->exists('uploads/passport/'.$pDetails->pp_img))
            {
                //dd('in');
                Storage::disk('public')->delete('uploads/passport/'.$pDetails->pp_img);
            }
            $pImage = Image::make($image)->resize(720, 1080)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/passport/' . $imagename, $pImage);
        } else {
            $imagename = $pDetails->pp_img;
        }
        $pDetails->pp_img = $imagename;
        $pDetails->save();
        Toastr::success('Item Stored Successfully','Success');
        return redirect()->route('admin.passport-stock.index');
    }

    public function destroy($id)
    {
        $stock =  Stock::find($id);
        $stock->delete();
        Toastr::success('Item Deleted Successfully','Success');
        return redirect()->back();
    }
    public function SupplierPassports($id)
    {
        $passengerDetails = PassengerDetails::where('supplier_id',$id)->get();
        $supplierDetails = Supplier::find($id);
        return view('backend.admin.passport_stock.passenger_list',compact('passengerDetails','supplierDetails'));
    }
}
