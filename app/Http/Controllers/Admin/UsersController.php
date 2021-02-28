<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('backend.admin.users.index', compact('users'));
    }

    public function create()
    {
        $role= Role::where('id', '!=', 1)->latest()->get();

        return view('backend.admin.users.create',compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

        $data = new user();
        $data->role_id = $request->role_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->confirm_password);
        //$data->confirm_password = $request->confirm_password;
        $data->save();
        Toastr::success('User Details Successfully Added');
        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        $role= Role::where('id', '!=', 1)->latest()->get();
        return view('backend.admin.users.edit',compact('user','role'));
    }

    public function update(Request $request, $id)
    {
        if ($request->new_password!=''){
            $this->validate($request,[
                'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6',
            ]);
        }else{
            $this->validate($request,[
                'role_id' => 'required',
                'name' => 'required',
                'email' => 'required',
            ]);
        }
        $data =  User::find($id);
        $data->role_id = $request->role_id;
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->new_password!=''){
            $data->password = Hash::make($request->confirm_password);
        }
        $data->save();

        Toastr::success('User Details Successfully Updated');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        //
    }
}
