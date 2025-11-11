<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;

class MemberController extends Controller
{
    public function index(Request $request){
        //$data['members'] = MemberModel::get();
        //$data['members'] = MemberModel::orderBy('id', 'asc')->paginate(2);
        $members = MemberModel::orderBy('id', 'desc');

        if($request->id){
            $members = $members->where('id', '=', $request->id);
        }

        if($request->member_code){
            $members = $members->where('member_code', '=', $request->member_code);
        }

        if($request->member_name){
            $members = $members->where('member_name', 'like', '%'.$request->member_name.'%');
        }

        if($request->address){
            $members = $members->where('address', 'like', '%'.$request->address.'%');
        }

        if($request->telephone){
            $members = $members->where('telephone', 'like', '%'.$request->telephone.'%');
        }

        if($request->created_at){
            $members = $members->where('created_at', 'like', '%'.$request->created_at.'%');
        }

        if($request->updated_at){
            $members = $members->where('updated_at', 'like', '%'.$request->updated_at.'%');
        }

        $members = $members->paginate(30);
        $data['members'] = $members;

        return view('member.list', $data);
    }

    public function add(Request $request){
        return view('member.add');
    }

    public function save(Request $request){
        $save = MemberModel::latest()->first() ?? new MemberModel();
        $code_number = (int)$save->member_code + 1;
        $save = new MemberModel();
        $save->member_code = $code_number;

        $save->member_name = trim($request->name);
        $save->address = trim($request->address);
        $save->telephone = trim($request->tel);
        $save->save();
        return redirect('admin/member')->with('success', 'Member added successfully');
    }

    public function edit($id, Request $request){
        $data['getMember'] = MemberModel::find($id);
        return view('member.edit', $data);
    }

    public function update($id, Request $request){
        $save = MemberModel::find($id);
        $save->member_name = trim($request->name);
        $save->address = trim($request->address);
        $save->telephone = trim($request->tel);
        $save->save();
        return redirect('admin/member')->with('success', 'Member updated successfully');
    }

    public function delete($id){
        $delete = MemberModel::find($id);
        $delete->delete();
        return redirect('admin/member')->with('error', 'Member deleted successfully');
    }
}