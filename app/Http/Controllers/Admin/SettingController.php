<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    use ImageTrait;
    public function index(){
        return view('Admin.setting');
    }
    public function update(Request $request){
        $request->validate([
            'name_en'=>'required',
            'name_ar'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'location'=>'required',
        ],[
            'name_en.required'=>__('all.validatenameen'),
            'name_ar.required'=>__('all.validatenamear'),
            'description_en.required'=>__('all.validatedescription_en'),
            'description_ar.required'=>__('all.validatedescription_ar'),
            'phone.required'=>__('all.validatephone'),
            'email.required'=>__('all.validateemail'),
            'location.required'=>__('all.validatelocation'),
        ]);
        $item=$request->except('token','Description_en','Description_ar');
        $setting=Setting::first();
        if($setting){
            if($request->hasFile('logo')){
                $path=$this->uploadimage($request->logo,'setting');
            }else{
                $path=$setting->logo;
            }
            $item['logo']=$path;
            $setting->update($item);
            return response()->json([
                'status'=>true,
                'logo'=>asset($setting->logo),
                'message'=>'Updated successfully'
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }

    }
}
