<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\AgentDetail;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index()

    {
        $agentDetails = AgentDetail::latest()->get();
        return view('backend.admin.agent-details.index', compact('agentDetails'));
    }

    public function create()
    {
        return view('backend.admin.agent-details.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required',
           'mobile' => 'required',

        ]);
        $data = new AgentDetail();
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

        Toastr::success('Agent Details Successfully Added');
        return redirect()->route('admin.agent.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $agentDetail = AgentDetail::find($id);
        return view('backend.admin.agent-details.edit', compact('agentDetail'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $data = AgentDetail::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->emergency_contact = $request->emergency_contact;
        $data->address = $request->address;
        $data->save();
        Toastr::success('Agent Details Successfully Updated');
        return redirect()->route('admin.agent.index');
    }

    public function destroy($id)
    {
        AgentDetail::destroy($id);
        Toastr::success('Agent Details Deleted Successfully','Success');
        return redirect()->route("admin.agent.index");
    }
}
