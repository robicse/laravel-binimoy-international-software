<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use App\ExpenseManage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExpenseManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense = DB::table('expense_manages')
            ->join('expense_categories', 'expense_manages.cate_id', '=', 'expense_categories.id')
            ->select('expense_categories.cate_name','expense_categories.id as category_id','expense_manages.*')
            ->get();

       /* $expense = ExpenseManage::join('expense_categories','expense_manages.cate_id', '=', 'expense_categories.id')
            ->where('expense_manages.cate_id','expense_categories.id')
            ->orderBy('id', 'DESC')
            ->get();*/
        return view('backend.admin.expense_manage.index', compact('expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ExpenseCategory::latest()->get();
        return  view('backend.admin.expense_manage.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'exp_title' => 'required',
            'cate_id' => 'required',
            'amount' => 'required'
        ]);

        $expense = new ExpenseManage();
        $expense->title = $request->exp_title;
        $expense->cate_id = $request->cate_id;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->date = date('Y-m-d');
        $expense->save();
        Toastr::success('Expense Created Successfully','Done!');
        return redirect()->route('admin.expense-manage.index');
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
        //dd($id);
        $exp_data = DB::table('expense_manages')
            ->join('expense_categories', 'expense_manages.cate_id', '=', 'expense_categories.id')
            ->where('expense_manages.id','=',$id)
            ->select('expense_categories.cate_name','expense_categories.id as category_id','expense_manages.*')
            ->first();
        //dd($exp_data);

        $exp_cate = ExpenseCategory::latest()->get();
        //$exp_data = ExpenseManage::find($id);
        return view('backend.admin.expense_manage.edit',compact('exp_data','exp_cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'exp_title' => 'required',
            'cate_id' => 'required',
            'amount' => 'required'
        ]);

        $exp_update = ExpenseManage::find($id);
        $exp_update->title = $request->exp_title;
        $exp_update->cate_id = $request->cate_id;
        $exp_update->amount = $request->amount;
        $exp_update->description = $request->description;
        $exp_update->save();
        Toastr::success('Expense Updated Successfully','Done!');
        return redirect()->route('admin.expense-manage.index');
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
