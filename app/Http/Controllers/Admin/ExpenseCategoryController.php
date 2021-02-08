<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_cate = ExpenseCategory::latest()->get();
        return view('backend.admin.expense_category.index', compact('expense_cate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('backend.admin.expense_category.create');
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
            'cate_name' => 'required'
        ]);

        $group = new ExpenseCategory();
        $group->cate_name = $request->cate_name;
        $group->save();
        Toastr::success('Expense Category Created Successfully','Done!');
        return redirect()->route('admin.expense-category.index');
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
        $exp_cate = ExpenseCategory::find($id);
        return view('backend.admin.expense_category.edit',compact('exp_cate'));
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
            'cate_name' => 'required'
        ]);

        $exp_cate_update = ExpenseCategory::find($id);
        $exp_cate_update->cate_name = $request->cate_name;
        $exp_cate_update->save();
        Toastr::success('Expense Category Updated Successfully','Done!');
        return redirect()->route('admin.expense-category.index');
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
