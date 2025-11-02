<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;

class MemberController extends Controller
{
    public function index(Request $request){
        return view('member.list');
    }

    public function add(Request $request){
        return view('member.add');
    }
}