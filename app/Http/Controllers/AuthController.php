<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function login_post(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (Auth::User()->is_role==1) {
                return redirect('admin/dashboard');
            } elseif (Auth::User()->is_role==2) {
                return redirect('user/dashboard');
            }else{
                return redirect(url('/'))->with('error','Invalid Login Credentials');
            }
        }else{
            return redirect(url('/'))->with('error','Invalid Login Credentials');
        }
    }

    public function logout(Request $request){
        Auth::logout();
            return redirect(url('/'));
    }
}
