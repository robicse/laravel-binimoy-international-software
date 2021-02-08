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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role= Role::where('id', '!=', 1)->latest()->get();

        return view('backend.admin.users.create',compact('role'));
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
        $user = User::find($id);
        $role= Role::where('id', '!=', 1)->latest()->get();
        return view('backend.admin.users.edit',compact('user','role'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
