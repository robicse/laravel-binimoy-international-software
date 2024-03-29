<?php

namespace App\Http\Controllers\ExecutiveOne;

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

class PassportStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passportStocks = Stock::sum('quantity');
        $passengerDetails = PassengerDetails::latest()->get();
        return  view('backend.executive_one.passport_stock.index',compact('passengerDetails','passportStocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::latest()->get();
        $suppliers = Supplier::all();
        return view('backend.executive_one.passport_stock.create',compact('groups','suppliers'));
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
            'supplier_id' => 'required',
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
        return redirect()->route('executive_one.passport-stock.index');
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
//        $groups = Group::all();
//        $suppliers = Supplier::all();
//        $stock = Stock::find($id);
        $pDetails = PassengerDetails::find($id);
        return view('backend.executive_one.passport_stock.edit', compact('pDetails'));
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
        return redirect()->route('executive_one.passport-stock.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        return view('backend.executive_one.passport_stock.passenger_list',compact('passengerDetails','supplierDetails'));
    }
}
