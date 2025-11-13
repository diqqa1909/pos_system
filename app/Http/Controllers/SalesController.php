<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesModel;
use App\Models\MemberModel;
use App\Models\User;
use Auth;

class SalesController extends Controller{
    public function index(){
        $getRecord = SalesModel::select('sales.*', 'member.member_name', 'users.name')
        ->join('member', 'member.member_code', '=', 'sales.member_id')
        ->join('users', 'users.id', '=', 'sales.user_id');
        
        if(Request()->id != ''){
            $getRecord = $getRecord->where('sales.id', '=', Request()->id);
        }
        if(Request()->member_name != ''){
            $getRecord = $getRecord->where('member.member_name', '=', Request()->member_name);
        }
        if(Request()->total_item != ''){
            $getRecord = $getRecord->where('sales.total_item', '=', Request()->total_item);
        }
        if(Request()->total_price != ''){
            $getRecord = $getRecord->where('sales.total_price', '=', Request()->total_price);
        }
        if(Request()->discount != ''){
            $getRecord = $getRecord->where('sales.discount', '=', Request()->discount);
        }
        if(Request()->accepted != ''){
            $getRecord = $getRecord->where('sales.accepted', '=', Request()->accepted);
        }
        if(Request()->username != ''){
            $getRecord = $getRecord->where('users.username', '=', Request()->username);
        }

        $getRecord = $getRecord->get();
        $data['getRecord'] = $getRecord;
        
        return view('sales.list', $data);
    }

    public function add(){
        $data['getMember'] = MemberModel::get();
        $data['getUser'] = User::where('is_role', '=', 2)->get();
        return view('sales.add', $data);
    }

    public function store(Request $request){
        $save = new SalesModel();
        $save->member_id = $request->member_id;
        $save->total_item = $request->total_item;
        $save->total_price = $request->total_price;
        $save->discount = $request->discount;
        $save->accepted = $request->accepted;
        $save->user_id = $request->username;
        $save->save();
        return redirect('admin/sales')->with('success', 'Record successfully saved! ');
    }

    public function edit($id){
        $data['getMember'] = MemberModel::get();
        $data['getUser'] = User::where('is_role', '=', 2)->get();
        $data['getEdit'] = SalesModel::find($id);
        return view('sales.edit', $data);
    }

    public function update(Request $request, $id){
        $update = SalesModel::find($id);
        $update->member_id = $request->member_id;
        $update->total_item = $request->total_item;
        $update->total_price = $request->total_price;
        $update->discount = $request->discount;
        $update->accepted = $request->accepted;
        $update->user_id = $request->username;
        $update->save();
        return redirect('admin/sales')->with('success', 'Record successfully updated! ');
    }

    public function delete($id){
        $delete = SalesModel::find($id);
        $delete->delete();
        return redirect('admin/sales')->with('success', 'Record successfully deleted! ');
    }

    public function delete_all(){
        SalesModel::truncate();
        return redirect('admin/sales')->with('success', 'All records successfully deleted! ');
    }
}