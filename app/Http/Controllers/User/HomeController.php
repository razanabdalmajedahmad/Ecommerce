<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Categure;
use App\Models\Prodact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categ=Categure::get();
        $newprodact=Prodact::where('condition','new')->where('status','active')->get();
        return view('users.pages.index',compact('newprodact','categ'));
    }
    public function filter_categure(Request $request){
        if($request->categure_id == 0){
            $prodact=Prodact::where('condition','new')->with('Categure')->where('status','active')->get();
        }else{
            $Categure=Categure::find($request->categure_id);
            $prodact=$Categure->Prodacts()->with('Categure')->where('condition','new')->where('status','active')->get();
        }
        foreach($prodact as $item){
            $item->setAttribute('logo', asset($item->image));
            $item->setAttribute('categure_name_en', $item->Categure->name_en);
            $item->setAttribute('categure_name_ar', $item->Categure->name_ar);
        }
        // dd($prodact);

        return response()->json([
            'status'=>true,
            'count'=>count($prodact),
            'data'=>$prodact
        ]);
    }
}
