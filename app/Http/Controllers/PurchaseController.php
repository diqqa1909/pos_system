<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseModel;
use App\Models\SupplierModel;
use Auth;

class PurchaseController extends Controller{
    public function index(){
        $data['datas'] = PurchaseModel::getRecords();
        return view('purchase.list', $data);
        
    }

    public function add(){
        $data['getRecords'] = SupplierModel::get();
        return view('purchase.add', $data);
    }

    public function store(Request $request){
        $data = new PurchaseModel();
        $data->supplier_id = $request->supplier_name;
        $data->total_item = $request->total_item;
        $data->total_price = $request->total_price;
        $data->discount = $request->discount;
        $data->save();
        return redirect('admin/purchase')->with('success', 'Purchase added successfully');
    }

    public function edit($id, Request $request){
        $data['getSuppliers'] = SupplierModel::get();
        $data['getRecords'] = PurchaseModel::find($id);
        return view('purchase.edit', $data);
    }

    public function update($id, Request $request){
        $data = PurchaseModel::find($id);
        $data->supplier_id = $request->supplier_name;
        $data->total_item = $request->total_item;
        $data->total_price = $request->total_price;
        $data->discount = $request->discount;
        $data->save();
        return redirect('admin/purchase')->with('success', 'Purchase updated successfully');
    }

    public function delete($id){
        $delete = PurchaseModel::find($id);
        $delete->delete();
        return redirect('admin/purchase')->with('error', 'Purchase deleted successfully');
    }
}