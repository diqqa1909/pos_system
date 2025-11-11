<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;
use App\Models\PurchaseModel;
use Auth;

class SupplierController extends Controller{
    public function index(Request $request){
        //$data['getRecords'] = SupplierModel::get();
        $data['getRecords'] = SupplierModel::getRecord();
        return view('supplier.list', $data);
    }

    public function delete($id){
        $delete = SupplierModel::find($id);
        $delete->delete();
PurchaseModel::where('purchase.supplier_id', '=', $id)->delete();
        return redirect('admin/supplier')->with('success', 'Member deleted successfully');
    }

    public function add(){
        return view('supplier.add');
    }

    public function store(Request $request){
        $supplier = new SupplierModel();
        $supplier->supplier_name = $request->name;
        $supplier->supplier_telephone = $request->tel;
        $supplier->supplier_address = $request->address;
        $supplier->save();

        return redirect('admin/supplier')->with('success', 'Supplier added successfully');
    }

    public function edit($id ,Request $request){
        $data['getSupplier'] = SupplierModel::find($id);
        return view('supplier.edit', $data);
    }

    public function update(Request $request, $id){
        $supplier = SupplierModel::find($id);
        $supplier->supplier_name = $request->name;
        $supplier->supplier_telephone = $request->tel;
        $supplier->supplier_address = $request->address;
        $supplier->save();
        return redirect('admin/supplier')->with('success', 'Supplier updated successfully');

    }
}

