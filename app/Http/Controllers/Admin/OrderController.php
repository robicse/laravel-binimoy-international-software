<?php

namespace App\Http\Controllers\Admin;

use App\Due;
use App\Group;
use App\Order;
use App\OrderDetail;
use App\PassengerDetails;
use App\PendingOrder;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OrderController extends Controller
{
    public function index(){
        $pending_orders = PendingOrder::latest()->get();
        return view('backend.admin.order.index', compact('pending_orders'));
    }

    public function visaStamped(){
        $orders = Order::latest()->get();
        return view('backend.admin.order.visa_stamped', compact('orders'));
    }

    public function payOrderDue(Request $request){
        //dd($request->all());
        $order_id = $request->order_id;
        $order = Order::find($order_id);

        $total_amount=$order->total_amount;
        $paid_amount=$order->pay_amount;

        $order->pay_amount=$paid_amount+$request->new_paid;
        $order->due_amount=$total_amount-($paid_amount+$request->new_paid);
        $order->update();

        $due = new Due();
        $due->ref_id = $order->id;
        // $due->invoice_no = $vstock->invoice_no;
        $due->total_amount =$order->total_amount;
        $due->paid_amount = $request->new_paid;
        $due->due_amount = $total_amount-($paid_amount+$request->new_paid);
        $due->save();

        Toastr::success('Due Pay Successfully', 'Success');
        return redirect()->back();

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
        return view('backend.admin.order.order_create', compact('passenger','suppliers','sup_id','groups'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'supplier_id' => 'required',
        ]);

        //dd($request->all());

        $invoice = mt_rand(111111,999999);
        $row_count = count($request->passenger_id);
        $order = new Order();
        $order->invoice_id = $invoice;
        $order->supplier_id = $request->supplier_id;
        $order->save();
        for ($i = 0; $i < $row_count; $i++) {

            if (empty($request->img[$i]) || empty($request->pc[$i]) || empty($request->mc[$i])){
                //dd($request->img[$i]);

                //print_r($request->img[$i]);
                $pending_order = new PendingOrder();
                $pending_order->order_id = $order->id;
                $pending_order->passenger_details_id = $request->passenger_id[$i];
                $pending_order->group_id = $request->group_id[$i];

                    if (!empty($request->img[$i])){
                        $photo_date = date('Y-m-d');
                    }else{
                        $photo_date = '';
                    }

                $pending_order->photo_date = $photo_date;
                $pending_order->pc = $request->pc[$i];

                    if (!empty($request->pc[$i])){
                    $pc_date = date('Y-m-d');
                    }else{
                    $pc_date = '';
                    }

                $pending_order->pc_date = $pc_date;
                $pending_order->mp = $request->mc[$i];
                    if (!empty($request->mc[$i])){
                        $mc_date = date('Y-m-d');
                    }else{
                        $mc_date = '';
                    }
                $pending_order->mp_date = $mc_date;

                $pending_order->visa_issue_date = $request->visa_issue_date[$i];

                if (!empty($request->img[$i])){
                    $image = $request->img[$i];
                    if (isset($image)) {
                        //make unique name for image
                        $currentDate = Carbon::now()->toDateString();
                        $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                        //resize image for category and upload
                        $pImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
                        Storage::disk('public')->put('uploads/visa/' . $imagename, $pImage);
                    } else {
                        $imagename = 'default.png';
                    }
                    $pending_order->photo = $imagename;
                }
                $pending_order->save();

            }elseif(!empty($request->img[$i]) || !empty($request->pc[$i]) || !empty($request->mc[$i])){
                //dd($request->img[$i]);

                $orderDetails = new OrderDetail();

                $orderDetails->order_id = $order->id;
                $orderDetails->supplier_id = $request->supplier_id;
                $orderDetails->passenger_details_id = $request->passenger_id[$i];
                $orderDetails->group_id = $request->group_id[$i];
//                $orderDetails->photo_date = $request->photo_date[$i];
                $orderDetails->pc = $request->pc[$i];
//                $orderDetails->pc_date = $request->pc_date[$i];
                $orderDetails->mp = $request->mc[$i];
    //                $orderDetails->mp_date = $request->mc_date[$i];

                if (!empty($request->img[$i])){
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
                }
                $orderDetails->save();
            }
            $passengerDetails = PassengerDetails::find($request->passenger_id[$i]);
            $passengerDetails->status = 1;
            $passengerDetails->save();

        }
        Toastr::success('Passport successfully added for visa','Success');
        return redirect()->route('admin.order.invoice',$order->id);
    }

    public function showOrderInvoice($id){
//dd('dd');
        $order = Order::find($id);
        $supplier = $order->supplier_id;
        $order_details = OrderDetail::where('order_id',$order->id)->get();

        return view('backend.admin.order.order_invoice', compact('order','supplier','order_details'));
    }

    public function orderInvoiceStore(Request $request){

//        $total_amount = 0;
//
//        $discount_type = $request->discount_type;
//        if($discount_type == 'flat'){
//            $total_amount -= $request->discount_amount;
//        }else{
//            $total_amount = ($total_amount*$request->discount_amount)/100;
//        }
        $order_update = Order::find($request->order_id);
        $order_update->total_amount = $request->total_amount;
        $order_update->discount = $request->discount;
        $order_update->pay_amount = $request->pay_amount;
        $order_update->due_amount = $request->due_amount;
        $order_update->payment_method = $request->payment_method;
        $order_update->save();
        $insert_id = $order_update->id;
    // due
        $due = new Due();
        $due->ref_id = $insert_id;
        $due->total_amount =$request->total_amount;
        $due->paid_amount = $request->pay_amount;
        $due->due_amount = $request->due_amount;
        $due->save();

        Toastr::success('Invoice successfully added for visa','Success');
        return redirect()->route('admin.order.invoice.view',$order_update->id);

        //dd($request->all());
    }

    public function orderInvoiceView($id){

        $order = Order::find($id);
        $supplier = $order->supplier_id;
        $order_details = OrderDetail::where('order_id',$order->id)->get();
        return view('backend.admin.order.order_invoice_view', compact('order','supplier','order_details'));


    }

    public function supplierWisePassportList($id){

        $passport_list = PassengerDetails::where('supplier_id',$id)->where('status','1')->get();



        return view('backend.admin.order.supplier_wise_pp_list', compact('passport_list'));
    }

    public function PassportStatusChange(Request $request,$id){

        $chage_status = PendingOrder::find($id);

        if (!empty($request->img)){
            $image = $request->img;
            if (isset($image)) {
              //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            //resize image for category and upload
                $pImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/visa/' . $imagename, $pImage);
            } else {
                $imagename = 'default.png';
            }
            $chage_status->photo = $imagename;
            $chage_status->photo_date = date('Y-m-d');
        }
        if (!empty($request->pc)) {
            $chage_status->pc = $request->pc;
            $chage_status->pc_date = date('Y-m-d');

        }
        if (!empty($request->mc)) {
            $chage_status->mp = $request->mc;
            $chage_status->mp_date = date('Y-m-d');
        }
            $chage_status->save();

        $update_orderdetails = PendingOrder::find($id);

        //dd($update_orderdetails);
        $pc_check = $update_orderdetails->pc;
        $img_check = $update_orderdetails->photo;
        $mp_check = $update_orderdetails->mp;

        $order_id = $update_orderdetails->order_id;
        $passenger_id = $update_orderdetails->passenger_details_id;
        $group_id = $update_orderdetails->group_id;

        //$pc_date = $update_orderdetails->pc_date;
        if ($update_orderdetails->pc_date ==''){
        $pc_date = date('Y-m-d');
        }else{
            $pc_date = $update_orderdetails->pc_date;
        }
        if ($update_orderdetails->mp_date ==''){
            $mp_date = date('Y-m-d');
        }else{
            $mp_date = $update_orderdetails->mp_date;
        }

        if ($update_orderdetails->photo_date ==''){
            $photo_date = date('Y-m-d');
        }else{
            $photo_date = $update_orderdetails->photo_date;
        }
        //$photo_date = $update_orderdetails->photo_date;
        $visa_issue_date = $update_orderdetails->visa_issue_date;

        $order_details = Order::find($update_orderdetails->order_id);
        $invoice = $order_details->invoice_id;
        $supplier_id = $order_details->supplier_id;


        if (!empty($pc_check) && !empty($img_check) && !empty($mp_check)){
            //dd('working Processing');
            $update = new OrderDetail();
            $update->order_id=$order_id;
            $update->supplier_id=$supplier_id;
            $update->passenger_details_id=$passenger_id;
            $update->group_id=$group_id;
            $update->v_issue_date=$visa_issue_date;
            $update->v_issue_date=$visa_issue_date;
            $update->mp=$mp_check;
            $update->mp_date=$mp_date;
            $update->pc=$pc_check;
            $update->pc_date=$pc_date;
            $update->photo=$img_check;
            $update->photo_date=$photo_date;

            $update->save();

            $delete = PendingOrder::find($id);
            $delete->delete();

        }
        Toastr::success('Status Update successfully for visa','Success');
        return redirect()->route('admin.order.index');

    }
}
