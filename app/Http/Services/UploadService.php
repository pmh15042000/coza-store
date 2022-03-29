<?php 
namespace App\Http\Services;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UploadService{
    public function store($request){
       try{
        if($request->hasFile('file')){
            $name= rand().'.'.$request->file('file')->getClientOriginalName();
            //path save img 80x80
            Image::make($request->file('file'))->resize(80,80)->save(storage_path('app/'.'public/images/products/80/'.$name));
            //path save img 150x150
            Image::make($request->file('file'))->resize(150,null,function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(storage_path('app/'.'public/images/products/150/'.$name));
            //path save img 500
                Image::make($request->file('file'))->resize(500,null,function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(storage_path('app/'.'public/images/products/500/'.$name));
                return $name;
        }elseif($request->hasFile('files')){
            foreach($request->file('files') as $sub_file){
                $name = rand().'.'.$sub_file->getClientOriginalName(); 
                 //path save img 80x80
                Image::make($sub_file)->resize(80,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/products/80/'.$name));
                //path save img 150x150
                Image::make($sub_file)->resize(150,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/products/150/'.$name));
                //path save img 500
                    Image::make($sub_file)->resize(500,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/products/500/'.$name));
                    $data[] = $name;
            }
            return json_encode($data);
        }
       }catch(\Exception $error){
        return $error;
       }
    }
    function storeSlider($request){
        try{
            if($request->hasFile('file')){
                $name= rand().'.'.$request->file('file')->getClientOriginalName();
                //path save img x80
                Image::make($request->file('file'))->resize(null,80,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/sliders/80/'.$name));
                //path save img x300
                Image::make($request->file('file'))->resize(null,300,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/sliders/300/'.$name));
                //path save img 1200
                    Image::make($request->file('file'))->resize(1200,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/sliders/1200/'.$name));
                    return $name;
            }
        }catch(\Exception $err){
            return $err;
        }
    }
    function storeMenu($request){
        try{
            if($request->hasFile('file')){
                $name= rand().'.'.$request->file('file')->getClientOriginalName();
                //path save img x80
                Image::make($request->file('file'))->resize(80,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/menus/80/'.$name));
                //path save img x300
                Image::make($request->file('file'))->resize(150,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/menus/150/'.$name));
                //path save img 1200
                    Image::make($request->file('file'))->resize(300,null,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(storage_path('app/'.'public/images/menus/300/'.$name));
                    return $name;
            }
        }catch(\Exception $err){
            return $err;
        }
    }
}
?>