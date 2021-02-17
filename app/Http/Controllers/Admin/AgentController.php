<?php

namespace App\Http\Controllers\Admin;

use App\AgentDetail;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
           'previous_pay' => 'required',
        ]);
        $data = new AgentDetail();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->emergency_contact = $request->emergency_contact;
        $data->address = $request->address;
        $data->previous_pay = $request->previous_pay;
        $data->save();
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
