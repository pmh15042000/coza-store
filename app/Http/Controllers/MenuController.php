<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductMainService;
use Illuminate\Http\Request;
class MenuController extends Controller
{
    protected $menuService;
    protected $productService;
    public function __construct(MenuService $menuService, ProductMainService $productService)
    {
        $this->menuService= $menuService;
        $this->productService= $productService;
    }
    public function index(Request $request,$id,$slug){
        $menu= $this->menuService->getID($id);
        $product= $this->menuService->getProduct($id);
        $products= $this->productService->getPro($product,$request);
        return View('menu',['title'=>$menu->name,'products'=>$products,'menu'=>$menu]);
    }
}
