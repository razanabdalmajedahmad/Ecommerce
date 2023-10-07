<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    use ImageTrait;
    public function index(){
        return view('Admin.dashboord.home');
    }
    public function profile(){
        $admin=Auth::user();
        return view('Admin.dashboord.profile.show',compact('admin'));
    }
    public function edit_profile(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:admins,email,' . Auth::user()->id,
            'phone'=>'unique:admins,phone,' . Auth::user()->id,
            'image'=>'mimes:png,jpg',
            'facebook'=>'nullable|url',
            'twitter'=>'nullable|url',
            'instagram'=>'nullable|url',
            'linkedin'=>'nullable|url',
        ],[
            'name.required'=>__('all.namerequired'),
            'email.required'=>__('all.emailrequired'),
            'email.unique'=>__('all.emailunique'),
            'phone.unique'=>__('all.phoneunique'),
            'url'=>__('all.url'),
        ]);
        if($request->hasFile('image')){
            $path=$this->uploadimage($request->image,'categure');
        }elseif($request->isdeleted == "1"){
            $path ='';
        }else{
            $path =Auth::user()->image;
        }
        $admin=Auth::user()->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'image'=>$path,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'instagram'=>$request->instagram,
            'linkedin'=>$request->linkedin,
            'address'=>$request->address,
            'country'=>$request->country,
        ]);
        if($admin){
            return response()->json([
                'status'=>true,
                'message'=>__('all.Updatedalert'),
                'image'=>asset(Auth::user()->image),
                'isnull'=>(Auth::user()->image)? true :false,
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }
    }
    public function change_password(Request $request){
        $request->validate([
            'newpassword'=>'required',
            'renewpassword'=>'required|same:newpassword',
            'currentPassword'=>'required',
        ],[
            'newpassword.required'=>__('all.newpasswordrequired'),
            'renewpassword.required'=>__('all.renewpasswordrequired'),
            'renewpassword.same'=>__('all.renewpasswordsame'),
            'currentPassword.required'=>__('all.currentPasswordrequired'),
        ]);
        if(Hash::check($request->currentPassword,Auth::user()->password)){
            Auth::user()->update([
                'password'=>Hash::make($request->newpassword)
            ]);
            return response()->json([
                'status'=>true,
                'message'=>__('all.change_password'),
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.MatchTheOldPassword'),
            ]);
        }
    }
}
