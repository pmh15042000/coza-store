<?php 
namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
class SliderService{
    function getShow(){
        return Slider::orderby('sort')->get();
    }
    function getAll(){
        return Slider::with('user:name,id')->paginate(3);
    }
    function insert($request){
        try{
            Slider::create([
                'name' => $request->name,
                'url' => $request->url,
                'thumb' => $request->thumb,
                'sort' => $request->order,
                'active' => $request->status,
                'user_id' => Auth::id(),
            ]);
            Session::flash('success','Thêm slider mới thành công');
        }catch(\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
    function update($request){
        try{
            if($request->thumb == ''){
                $thumb= $request->old_thumb;
            }else{
                $thumb=$request->thumb;
            }
            Slider::where('id',$request->id)->update([
                'name'=> $request->name,
                'url'=> $request->url,
                'thumb'=> $thumb,
                'sort'=> $request->order,
                'active'=> $request->status,
                'user_id'=> Auth::id(),
            ]);
            Session::flash('success','Update dữ liệu thành công');
        }catch(\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
    function destroy($id){
       $item =Slider::find($id);
       if($item){
        return $item->delete();
    }
    return false;
    }
}

?>