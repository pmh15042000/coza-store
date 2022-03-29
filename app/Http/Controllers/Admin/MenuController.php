<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\CreateRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;
    function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    function index(){
        return view('admin.menu.show',['menus'=>$this->menuService->getAll(),'title'=>'Danh sách menu']);
    }
    function create(){
        
        return view('admin.menu.add',[
            'title'=>'Thêm danh mục mới',
            'menus'=> $this->menuService->getParent(),
        ]);
    }
    function store(CreateRequest $request){
        $this->menuService->create($request);
        return redirect()->back();
    }
    function destroy(Request $request)  
    {
        $result= $this->menuService->destroy($request);
        if($result == true){
            return response()->json([
                'error' => false,
                'message'=> 'Xóa thành công danh mục',
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
    function edit(Menu $id){
        return view('admin.menu.edit',['title'=>' Sửa danh mục: '.$id->name,'menu'=>$id,'menus'=> $this->menuService->getParent()]);
    }
    function update(Menu $id,CreateRequest $request)
    {
        
        $this->menuService->update($request,$id);
        return redirect()->route('menu.list');
    }
    function getSub(Request $request){
        return $this->menuService->getsubmenu($request);
    }
}
