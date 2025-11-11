<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;
use Auth;

class ExpenseController extends Controller{
    public function index(Request $request){
        $getRecord = ExpenseModel::orderBy('id', 'desc');

        if ($request->id) {
            $getRecord = $getRecord->where('id', '=', $request->id);
        }
        if ($request->description) {
            $getRecord = $getRecord->where('description', 'like', '%'.$request->description.'%');
        }
        if ($request->amount) {
            $getRecord = $getRecord->where('amount', 'like', '%'.$request->amount.'%');
        }
        if ($request->created_at) {
            $getRecord = $getRecord->where('created_at', 'like', '%'.$request->created_at.'%');
        }
        if ($request->updated_at) {
            $getRecord = $getRecord->where('updated_at', 'like', '%'.$request->updated_at.'%');
        }

        $getRecord = $getRecord->paginate(2);
        $data['getRecord'] = $getRecord;

        return view('expense.list', $data);
    }

    public function add(){
        return view('expense.add');
    }

    public function store(Request $request){
        $expense = new ExpenseModel();
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();
        return redirect('admin/expense')->with('success', 'Expense added successfully');
    }

    public function edit($id, Request $request){
        $data['getExpense'] = ExpenseModel::find($id);
        return view('expense.edit', $data);
    }

    public function update($id, Request $request){
        $expense = ExpenseModel::find($id);
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();
        return redirect('admin/expense')->with('success', 'Expense added successfully');
    }

    public function delete($id){
        $delete = ExpenseModel::find($id);
        $delete->delete();
        return redirect('admin/expense')->with('error', 'Expense deleted successfully');
    }
}