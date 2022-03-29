<?php 
namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class MenuService
{
    function getID($id){
        return Menu::where('id',$id)->where('active',1)->firstOrFail();
    }
    function getShow(){
        return Menu::orderby('id')->where('active',1)->where('parent_id',0)->get();
    }
    function getParent(){
        return Menu::where('parent_id',0)->get();
    }
    function getAll(){
        return Menu::orderBy('id')->paginate(20);
    }
    function create($request){
        try{
            Menu::create([
                'name'=> $request->input('name'),
                'parent_id' => $request->input('parent_id'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
                'active'=> $request->input('status'),
                'slug' => Str::slug($request->input('name'),'-'),
                'thumb' => $request->input('thumb')
            ]);
            Session::flash('success','Thêm danh mục thành công');
        }catch(\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
    function destroy($request){
        $id= $request->input('id');
        $menu= Menu::where('id',$id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }
    function update($request,$menu){
        $menu->name= $request->input('name');
        $menu->parent_id = $request->input('parent_id');
        $menu->description = $request->input('description');
        $menu->content = $request->input('content');
        $menu->active = $request->input('status');
        $menu->slug = Str::slug($request->input('name'));
        $menu->thumb= $request->thumb;
        $menu->save();
        Session::flash('success','Cập nhật thành công danh mục');
        return true;
    }
    function getsubmenu($request){
        $id= $request->id;
        $submenu= Menu::where('parent_id',$id)->get();
        return response()->json($submenu);
    }
    function getProduct($menu){
        return  Menu::where('parent_id', $parentId = Menu::where('id', $menu)
        ->value('id'))
        ->pluck('id')
        ->push($parentId)
        ->all();


    }
}
?>