<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('Admin.auth.login');
    }
    public function login_post(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $credentials=$request->only(['email','password']);
        if( auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            toastr('Logged in successfully.');
            return redirect()->route('admin_home');
        }else{
            toastr('These credentials do not match our records.','warning');
            return redirect()->back();
        }
    }
}
