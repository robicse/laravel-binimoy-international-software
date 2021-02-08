<?php


namespace App\Http\Controllers\Admin;

use App\AgentDetail;
use App\ExpenseManage;
use App\GroupWiseVisa;
use App\Order;
use App\OrderDetail;
use App\PassengerDetails;
use App\Supplier;
use App\TakeAgentPayment;
use App\TakePayment;
use App\VisaStock;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AccountController
{
    public function index(){
        $orders = Order::latest()->get();

        return view('backend.admin.accounts.index', compact('orders'));
    }

    public function TakePayment($id){
        $order_details = Order::find($id);

        return view('backend.admin.accounts.take_payment',compact('order_details'));
    }

    public function store(Request $request){
        //dd($request->all());

        $Order_amount_update = Order::find($request->id);
        $total_pay = $Order_amount_update->pay_amount + $request->pay_amount;
        $Order_amount_update->pay_amount = $total_pay;
        $Order_amount_update->due_amount = $request->due_amount;
        $Order_amount_update->save();

        $take_payment = new TakePayment();
        $take_payment->invoice_id = $request->invoice_id;
        $take_payment->supplier_id = $request->supplier_id;
        $take_payment->payable_amount = $request->payable_amount;
        $take_payment->pay_amount = $request->pay_amount;
        $take_payment->due_amount = $request->due_amount;
        $take_payment->payment_method = $request->payment_method;
        $take_payment->save();

        $take_payment_data = TakePayment::latest()->first();
        //$payment_id = $take_payment_data->id;
        Toastr::success('Payment Against Invoice Successfully Added');
        return redirect()->route('admin.accounts.pay.slip',$take_payment_data->id);
        //return view('backend.admin.accounts.pay_slip');
    }

    public function TakePaymentSlip($id){
        $take_payment_data = TakePayment::find($id);
        $payment_id = $take_payment_data->id;
        $order_data = Order::where('invoice_id',$take_payment_data->invoice_id)->first();
        return view('backend.admin.accounts.pay_slip',compact('payment_id','take_payment_data','order_data'));
    }

    public function orderInvoiceView($id){
        $order = Order::find($id);
        $supplier = $order->supplier_id;
        $order_details = OrderDetail::where('order_id',$order->id)->get();
        return view('backend.admin.accounts.order_invoice_view', compact('order','supplier','order_details'));
    }

    public function supplierWisePassportList($id){
        $passport_list = PassengerDetails::where('supplier_id',$id)->where('status','1')->get();

        return view('backend.admin.order.supplier_wise_pp_list', compact('passport_list'));
    }

    public function CashReceive(){
        $orders = Order::where('payment_method','1')->get();

        return view('backend.admin.cash-receive.index', compact('orders'));

    }

    public function BankReceive(){

        $orders = Order::where('payment_method','2')->get();

        return view('backend.admin.bank-receive.index', compact('orders'));
    }

    public function BalanceSheet(){

        $orders = Order::latest()->get();

        $cash = Order::where('payment_method','1')->sum('pay_amount');
        $bank = Order::where('payment_method','2')->sum('pay_amount');
        $receivable = Order::sum('due_amount');
        $stock = GroupWiseVisa::sum('total_price');

        $expense = ExpenseManage::sum('amount');
        $agentCost = VisaStock::sum('pay_amount');
        $visa_payable = VisaStock::sum('due_amount');
        $pre_payable = AgentDetail::sum('previous_pay');
        $payable = $visa_payable + $pre_payable;
        return view('backend.admin.balance-sheet.index', compact('orders','cash','bank','expense','receivable','agentCost','payable','stock'));
    }

    public function AgentPayment()
    {
        $agentDetails = AgentDetail::latest()->get();

        return view('backend.admin.agent-payment.index', compact('agentDetails'));
    }

    public function AgentPaymentHistory($id){
        //dd($id);
        $VisaStocks = VisaStock::where('agent_id',$id)->sum('quantity');
        $VisaStocks_details = VisaStock::where('agent_id',$id)->get();

        return view('backend.admin.agent-payment.history', compact('VisaStocks','VisaStocks_details'));
    }

    public function AgentPaymentCreate(Request $request){

         $takePayment = new TakeAgentPayment();

        $takePayment->agent_id = $request->agent_id;
        $takePayment->payable_amount = $request->payable_amount;
        $takePayment->pay_amount = $request->pay_amount;
        $takePayment->due_amount = $request->payable_amount - $request->pay_amount;
        $takePayment->date = date('Y-m-d');
        $takePayment->save();

        Toastr::success('Agent payment successfully added','Success');
        return redirect()->route('admin.accounts.agent.payment');

        //return view('backend.admin.agent-payment.create', compact('VisaStocks','VisaStocks_details'));
    }
    public function IncomeStatement(){

        $order = Order::latest()->get();
        $total_income = Order::sum('pay_amount');
        $total_expense = ExpenseManage::sum('amount');
        $total_ticket_cost = VisaStock::sum('pay_amount');
        return view('backend.admin.accounts.income_statement', compact('order','total_income','total_expense','total_ticket_cost'));
    }
}


