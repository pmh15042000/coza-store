<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductMainService;
use App\Http\Services\Slider\SliderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    //
    protected $slider;
    protected $menu;
    protected $product;
    
    function __construct(SliderService $slider,MenuService $menu,ProductMainService $product)
    {
        $this->slider= $slider;
        $this->menu= $menu;
        $this->product= $product;
    }
    function index(){
        // Session::forget('carts');
        // dd(session::all());
        return view('home',['title'=>'Minghstore','sliders'=>$this->slider->getShow(),'menus'=>$this->menu->getShow(),'products'=>$this->product->get(),]);
    }
    function loadProduct(Request $request){
        
        $page= $request->input('page',0);
        $result= $this->product->get($page);
        if(count($result) != 0){
            $html =view('products.list',['products'=>$result])->render();
            return response()->json(['html'=>$html]);
        }
        return  response()->json(['html'=>'']);

    }
}
