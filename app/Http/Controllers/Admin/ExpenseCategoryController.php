<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ExpenseCategoryController extends Controller
{

    public function index()
    {
        $expense_cate = ExpenseCategory::latest()->get();
        return view('backend.admin.expense_category.index', compact('expense_cate'));
    }

    public function create()
    {
        return  view('backend.admin.expense_category.create');
    }
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
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $exp_cate = ExpenseCategory::find($id);
        return view('backend.admin.expense_category.edit',compact('exp_cate'));
    }

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

    public function destroy($id)
    {
        //
    }
}
