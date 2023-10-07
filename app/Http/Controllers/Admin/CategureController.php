<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categure;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use App\Traits\ImageTrait;

class CategureController extends Controller
{
    use ImageTrait;

    public function index(Request $request)
    {
        return view('Admin.dashboord.categure.list');
    }
    public function show(Request $request)
    {
        $data = Categure::select('*');

        if(!empty($request->get('query'))){
            $serch=$request->get('query');
            (app()->getLocale() == 'en') ? $data=$data->where('name_en', 'LIKE', "%$serch%") :$data=$data->where('name_ar', 'LIKE', "%$serch%");
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn ='<a href="'.route('Categure_update',$row->id).'" class="btn btn-success">'.__('all.Edit').'</a>
                <button  class="btn btn-danger delete">'.__('all.Delete').'</button>';
                return $actionBtn;
            })
            ->addColumn('name', function($row){
                (app()->getLocale() == 'en') ? $name =$row->name_en :$name =$row->name_ar;
                return $name;
            })
            ->addColumn('image_edit', function($row){
                $img="<img src='".asset($row->image)."' style='width:50%;height:120px' class='ml-5'>";
                return $img;
            })
            ->rawColumns(['action','name','image_edit'])
            ->make(true);
    }
    public function createnew(){
        return view('Admin.dashboord.categure.create');
    }
    public function store(Request $request){
        $role=$this->role();
        $message=$this->message();
        $request->validate($role,$message);
        ($request->hasFile('image'))? $path=$this->uploadimage($request->image,'categure') : $path = '';
        $categure=Categure::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'image'=>$path,
        ]);
        if($categure){

            (app()->getLocale() == 'en')?$position='toast-top-right':$position='toast-top-left';
            toastr(__('all.success'),'','',['positionClass'=>$position]);
            return response()->json([
                'status'=>true,
                'message'=>'categure created successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }
    }
    public function role(){
        return [
            'name_en'=>'required',
            'name_ar'=>'required',
            'image'=>'required'
        ];
    }
    public function message(){
        return [
            'name_en.required'=>__('all.validatenameen'),
            'name_ar.required'=>__('all.validatenamear'),
            'image.required'=>__('all.validateimage')
        ];
    }

    public function edit($id){
        $categure=Categure::findOrFail($id);
        return view('Admin.dashboord.categure.update',compact('categure'));
    }
    public function update(Request $request){
        $request->validate([
            'name_en'=>'required',
            'name_ar'=>'required',
        ],[
            'name_en.required'=>__('all.validatenameen'),
            'name_ar.required'=>__('all.validatenamear'),
        ]);
        $categure=Categure::find($request->id);
        if($categure){
            $categure->name_ar=$request->name_ar;
            $categure->name_en=$request->name_en;
            if($request->hasFile('image')){
                if (File::exists($categure->image)) {
                    File::delete($categure->image);
                }
                $categure->image=$this->uploadimage($request->image,'categure');
            }
            $categure->save();
            (app()->getLocale() == 'en')?$position='toast-top-right':$position='toast-top-left';
            toastr(__('all.Updatedalert'),'','',['positionClass'=>$position]);
            return response()->json([
                'status'=>true,
                'message'=>'Updated successfully'
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }
    }
    public function delete(Request $request){
        $categure=Categure::find($request->id);
        if($categure){
            if (File::exists($categure->image)) {
                File::delete($categure->image);
            }
            $categure->Prodacts()->delete();
            $categure->delete();
            // toastr('Deleted successfully.');
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
