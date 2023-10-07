<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categure;
use App\Models\Prodact;
use App\Models\ProdactImage;
use App\Models\ProdactSize;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\Support\Facades\File;

class ProdactController extends Controller
{
    use ImageTrait;
    public function index(){
        $categ=Categure::get();
        return view('Admin.dashboord.prodact.list',compact('categ'));
    }
    public function createnew(){
        $categ=Categure::get();
        return view('Admin.dashboord.prodact.create',compact('categ'));
    }
    public function store(Request $request){
        $request->validate([
            'name_en'=>'required',
            'name_ar'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',
            'quantity'=>'required',
            'categure'=>'required',
            'price'=>'required',
            'condition'=>'required',
            'status'=>'required',
            'size'=>'required',
            'image'=>'required',
            'discount'=>[Rule::requiredIf($request->condition && $request->condition == "cuts"),'nullable','integer','between:0,100']
        ],[
            'name_en.required'=>__('all.validatenameen'),
            'name_ar.required'=>__('all.validatenamear'),
            'image.required'=>__('all.validateimage'),
            'description_en.required'=>__('all.validatedescription_en'),
            'description_ar.required'=>__('all.validatedescription_ar'),
            'quantity.required'=>__('all.validatequantity'),
            'price.required'=>__('all.validateprice'),
            'categure.required'=>__('all.validatecategure'),
            'status.required'=>__('all.validatestatus'),
            'condition.required'=>__('all.validatecondition'),
            'size.required'=>__('all.validatesize'),
            'discount.required'=>__('all.validatediscount'),
            'discount.between'=>__('all.validatediscountbetween'),
        ]);
        ($request->hasFile('image')) ? $path=$this->uploadimage($request->image,'prodact') : $path = '';
        ($request->hasFile('video')) ? $pathvideo=$this->uploadimage($request->video,'prodact') : $pathvideo = '';
        $prodact=Prodact::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'quantity'=>$request->quantity,
            'categure'=>$request->categure,
            'price'=>$request->price,
            'condition'=>$request->condition,
            'status'=>$request->status,
            'image'=>$path,
            'discount'=>$request->discount,
            'video'=>$pathvideo,
        ]);
        if($prodact){
            if(count($request->size)>0){
                for($i=0;$i<count($request->size);$i++){
                    ProdactSize::create([
                        'size'=>$request->size[$i],
                        'prodact_id'=>$prodact->id
                    ]);
                }
            }
            if($request->images && count($request->images)>0){
                for($i=0;$i<count($request->images);$i++){
                    $path=$this->uploadimage($request->images[$i],'prodact');
                    ProdactImage::create([
                        'path'=>$path,
                        'prodact_id'=>$prodact->id
                    ]);
                }
            }
            (app()->getLocale() == 'en') ? $position='toast-top-right':$position='toast-top-left';
            toastr(__('all.success'),'','',['positionClass'=>$position]);
            return response()->json([
                'status'=>true,
                'message'=>'prodact created successfully'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.error')
            ]);
        }

    }
    public function show(Request $request){
        $prodact=Prodact::select('*');
        if(!empty($request->get('query'))){
            $serch=$request->get('query');
            (app()->getLocale() == 'en') ? $prodact=$prodact->where('name_en', 'like', "%$serch%") :$prodact=$prodact->where('name_ar', 'like', "%$serch%");
        }

        if(!empty($request->get('categure'))){
            $prodact=$prodact->where('categure',$request->get('categure') );
        }
        if(!empty($request->get('status'))){
            $prodact=$prodact->where('status',$request->get('status') );
        }
        if(!empty($request->get('condition'))){
            $prodact=$prodact->where('condition',$request->get('condition') );
        }
        return Datatables::of($prodact)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn ='<a href="'.route('prodact_update',$row->id).'" class="btn btn-success">'.__('all.Edit').'</a>
                <button  class="btn btn-danger delete">'.__('all.Delete').'</button>
                <button type="button" class="btn btn-primary showimage" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                '.__('all.showimage').'
              </button>';
                return $actionBtn;
            })
            ->addColumn('image_edit', function($row){
                $img="<img src='".asset($row->image)."' style='width:50%;height:120px' class='ml-5'>";
                return $img;
            })
            ->addColumn('video_edit', function($row){
                if($row->video){
                    $video='<video width="150" height="150" id="video"controls>
                    <source src="'.asset($row->video).'" id="videosrc" type="video/mp4">
                </video>';
                }else{
                    $video="";
                }
                return $video;
            })
            ->addColumn('size_edit', function($row){
                $ro="";
                foreach($row->Size as $item){
                    if($item->size == "S"){
                        $ro.=' '.__('all.Small');
                    }elseif($item->size == "L"){
                        $ro.=' '.__('all.Large');
                    }
                    elseif($item->size == "xL"){
                        $ro.=' '.__('all.ExtraLarge');
                    }
                    else{
                        $ro.=' '.__('all.Medium');
                    }

                }
                return  substr(str_replace(' ',',',$ro),1);
            })
            ->addColumn('categure_edit', function($row){
                return (app()->getLocale() == 'en') ? $row->Categure->name_en : $row->Categure->name_ar;
            })
            ->rawColumns(['action','image_edit','description_ar','description_en','video_edit'])
            ->make(true);
    }
    public function edit($id){
        $prodact=Prodact::findOrFail($id);
        $categ=Categure::get();
        $size=$prodact->Size()->pluck('size')->toArray();
        return view('Admin.dashboord.prodact.update',compact('prodact','categ','size'));
    }
    public function update(Request $request){
        // dd($request->all());
        $request->validate([
            'name_en'=>'required',
            'name_ar'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',
            'quantity'=>'required',
            'categure'=>'required',
            'price'=>'required',
            'condition'=>'required',
            'status'=>'required',
            'size'=>'required',
            'discount'=>[Rule::requiredIf($request->condition && $request->condition == "cuts"),'nullable','integer','between:0,100']
        ],[
            'name_en.required'=>__('all.validatenameen'),
            'name_ar.required'=>__('all.validatenamear'),
            'description_en.required'=>__('all.validatedescription_en'),
            'description_ar.required'=>__('all.validatedescription_ar'),
            'quantity.required'=>__('all.validatequantity'),
            'price.required'=>__('all.validateprice'),
            'categure.required'=>__('all.validatecategure'),
            'status.required'=>__('all.validatestatus'),
            'condition.required'=>__('all.validatecondition'),
            'size.required'=>__('all.validatesize'),
            'discount.required'=>__('all.validatediscount'),
            'discount.between'=>__('all.validatediscountbetween'),
        ]);
        $prodact=Prodact::find($request->id);
        if($prodact){
            $prodact->name_en=$request->name_en;
            $prodact->name_ar=$request->name_ar;
            $prodact->description_en=$request->description_en;
            $prodact->description_ar=$request->description_ar;
            $prodact->quantity=$request->quantity;
            $prodact->categure=$request->categure;
            $prodact->price=$request->price;
            $prodact->condition=$request->condition;
            $prodact->status=$request->status;
            $prodact->discount=$request->discount;
            if($request->hasFile('image')){
                if (File::exists($prodact->image)) {
                    File::delete($prodact->image);
                }
                $prodact->image=$this->uploadimage($request->image,'prodact');
            }
            if($request->hasFile('video')){
                if (File::exists($prodact->video)) {
                    File::delete($prodact->video);
                }
                $prodact->video=$this->uploadimage($request->video,'prodact');
            }
            $prodact->save();
            if($request->images_id){
                $prodact->images()->whereNotin('id',$request->images_id)->delete();
            }else{
                $prodact->images()->delete();
            }
            if($request->images && count($request->images)>0){
                for($i=0;$i<count($request->images);$i++){
                    $path=$this->uploadimage($request->images[$i],'prodact');
                    ProdactImage::create([
                        'path'=>$path,
                        'prodact_id'=>$prodact->id
                    ]);
                }
            }
            $prodact->size()->delete();
            if(count($request->size)>0){
                for($i=0;$i<count($request->size);$i++){
                    ProdactSize::create([
                        'size'=>$request->size[$i],
                        'prodact_id'=>$prodact->id
                    ]);
                }
            }
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
        $prodact=Prodact::find($request->id);
        if($prodact){
            $prodact->images()->delete();
            $prodact->size()->delete();
            if (File::exists($prodact->image)) {
                File::delete($prodact->image);
            }
            if (File::exists($prodact->video)) {
                File::delete($prodact->video);
            }
            $prodact->delete();
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
    public function showimage(Request $request){
        $prodact=Prodact::find($request->id);
        $data=$prodact->images()->get();
        if(count($data)> 0){
            foreach($data as $key){
                $asset[]=asset($key->path);
            }
            return response()->json([
                'status'=>true,
                'message'=>$asset
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>__('all.datatable.zeroRecords')
            ]);
        }
    }
}
