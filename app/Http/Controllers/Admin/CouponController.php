<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use DataTables;

class CouponController extends Controller
{
    public function index(){
        return view('Admin.dashboord.coupon.list');
    }
    public function show(Request $request){
        $data = Coupon::select('*');

        if(!empty($request->get('query'))){
            $serch=$request->get('query');
            $data=$data->where('code', 'LIKE', "%$serch%")->orwhere('value','LIKE', "%$serch%");
        }
        if(!empty($request->get('status'))){
            $data=$data->where('status',$request->get('status') );
        }
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn ='<a href="'.route('coupon_update',$row->id).'" class="btn btn-success">'.__('all.Edit').'</a>
                <button  class="btn btn-danger delete">'.__('all.Delete').'</button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function createnew(){
        return view('Admin.dashboord.coupon.cretae');
    }
    public function store(Request $request){
        $request->validate([
            'code'=>'required',
            'value'=>'required|integer|between:0,100',
            'status'=>'required',
        ],[
            'status.required'=>__('all.validatestatus'),
            'code.required'=>__('all.validatecode'),
            'value.required'=>__('all.validatevalue'),
            'value.between'=>__('all.validatevaluecountbetween'),
        ]);
        $Coupon=Coupon::create([
            'code'=>$request->code,
            'value'=>$request->value,
            'status'=>$request->status,
        ]);
        if($Coupon){
            (app()->getLocale() == 'en') ? $position='toast-top-right':$position='toast-top-left';
            toastr(__('all.success'),'','',['positionClass'=>$position]);
            return response()->json([
                'status'=>true,
                'message'=>'Coupon created successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }
    }
    public function edit($id){
        $Coupon=Coupon::findOrFail($id);
        return view('Admin.dashboord.coupon.edit',compact('Coupon'));
    }
    public function update (Request $request){
        $request->validate([
            'code'=>'required',
            'value'=>'required|integer|between:0,100',
            'status'=>'required',
        ],[
            'status.required'=>__('all.validatestatus'),
            'code.required'=>__('all.validatecode'),
            'value.required'=>__('all.validatevalue'),
            'value.between'=>__('all.validatevaluecountbetween'),
        ]);
        $Coupon=Coupon::find($request->id);
        if($Coupon){
            $Coupon->update([
                'code'=>$request->code,
                'value'=>$request->value,
                'status'=>$request->status,
            ]);
            (app()->getLocale() == 'en') ? $position='toast-top-right':$position='toast-top-left';
            toastr(__('all.success'),'','',['positionClass'=>$position]);
            return response()->json([
                'status'=>true,
                'message'=>'Coupon Updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }
    }
    public function delete(Request $request){
        $Coupon=Coupon::find($request->id);
        if($Coupon){
            $Coupon->delete();
            return response()->json([
                'status'=>true,
                'message'=>__('all.deletealert')
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }
    }
}
