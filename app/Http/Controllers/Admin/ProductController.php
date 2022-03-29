<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productService;
    protected $menu;
    function __construct(ProductService $productService,MenuService $menu)
    {
        $this->productService= $productService;
        $this->menu = $menu;
    }

    public function index()
    {   $menu = $this->menu->getParent();
        $products= $this->productService->getALl();
        return view('admin.product.show',['title'=>'Danh sách sản phẩm','products'=>$products,'menu'=>$menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = $this->menu->getParent();
        return view('admin.product.add',['title'=>'Thêm sản phẩm','menu'=>$menu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   
       
        $isValidPrice =$this->productService->isValidPrice($request);
        if($isValidPrice == false) return redirect()->back();
     
        $this->productService->store($request);
        return redirect()->route('product.list');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= $this->productService->getProductByID($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        $this->productService->update($request);
        return redirect()->route('product.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $result= $this->productService->destroy($id);
        if($result == false){
            Session::flash('error','Xóa sản phẩm thất bại ');
            return redirect()->route('product.list');
        }
        Session::flash('success','Xóa thành công danh mục');
        return redirect()->route('product.list');
    }
}
