<?php


namespace App\Http\Controllers\ExecutiveTwo;

use App\Group;
use App\Order;
use App\OrderDetail;
use App\PassengerDetails;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\ExecutiveTwo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class OrderController
{
    public function index(){
        $orders = Order::latest()->get();

        return view('backend.executive_two.order.index', compact('orders'));
    }


    public function showOrderForm()
    {
        $sup_id  = Input::get('supplier_id');
        $suppliers = Supplier::all();
        $groups = DB::table('groups')
            ->join('group_wise_visas','group_wise_visas.group_id','=','groups.id')
            ->select('groups.id','groups.name','groups.gr','group_wise_visas.group_id')
            ->groupBy('group_wise_visas.group_id')
            ->get();
        //$groups = Group::all();
        if (!empty($sup_id)){
            $passenger = PassengerDetails::where('supplier_id',$sup_id)->where('status',0)->get();
        }else{
            $passenger = PassengerDetails::where('status',0)->get();
        }


        return view('backend.executive_two.order.order_create', compact('passenger','suppliers','sup_id','groups'));
    }

    public function store(Request $request)
    {
        $invoice = mt_rand(111111,999999);
        $row_count = count($request->passenger_id);
        $order = new Order();
        $order->invoice_id = $invoice;
        $order->supplier_id = $request->supplier_id;
        $order->save();
        for ($i = 0; $i < $row_count; $i++) {
            $orderDetails = new OrderDetail();
            $orderDetails->order_id = $order->id;
            $orderDetails->supplier_id = $request->supplier_id;
            $orderDetails->passenger_details_id = $request->passenger_id[$i];
            $orderDetails->group_id = $request->group_id[$i];
            $orderDetails->photo_date = $request->photo_date[$i];
            $orderDetails->pc = $request->pc[$i];
            $orderDetails->pc_date = $request->pc_date[$i];
            $orderDetails->mp = $request->mc[$i];
            $orderDetails->mp_date = $request->mc_date[$i];
            $image = $request->img[$i];
            if (isset($image)) {//make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for category and upload
                $pImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/visa/' . $imagename, $pImage);
            } else {
                $imagename = 'default.png';
            }
            $orderDetails->photo = $imagename;
            $orderDetails->save();
            $passengerDetails = PassengerDetails::find($request->passenger_id[$i]);
            $passengerDetails->status = 1;
            $passengerDetails->save();
        }
        Toastr::success('Passport successfully added for visa','Success');
        return redirect()->route('executive.two.order.invoice',$order->id);
    }

    public function showOrderInvoice($id){

        $order = Order::find($id);
        $supplier = $order->supplier_id;
        $order_details = OrderDetail::where('order_id',$order->id)->get();

        return view('backend.executive_two.order.order_invoice', compact('order','supplier','order_details'));
    }

    public function orderInvoiceStore(Request $request){

        $order_update = Order::find($request->order_id);
        $order_update->total_amount = $request->total_amount;
        $order_update->discount = $request->discount;
        $order_update->pay_amount = $request->pay_amount;
        $order_update->due_amount = $request->due_amount;
        $order_update->save();

        Toastr::success('Invoice successfully added for visa','Success');
        return redirect()->route('executive.two.order.invoice.view',$order_update->id);

        //dd($request->all());
    }

    public function orderInvoiceView($id){

        $order = Order::find($id);
        $supplier = $order->supplier_id;
        $order_details = OrderDetail::where('order_id',$order->id)->get();
        return view('backend.executive_two.order.order_invoice_view', compact('order','supplier','order_details'));


    }

    public function supplierWisePassportList($id){

        $passport_list = PassengerDetails::where('supplier_id',$id)->where('status','1')->get();



        return view('backend.executive_two.order.supplier_wise_pp_list', compact('passport_list'));
    }

}
