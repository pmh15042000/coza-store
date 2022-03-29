<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductMainService;
class ProductController extends Controller
{
    protected $productService;
    function __construct(ProductMainService $productService)
    {
         $this->productService=$productService;
    }
    function index($id='',$slug=''){
        $this->productService->addView($id);
        $product= $this->productService->show($id);
        $productMore= $this->productService->getMore($id);
        return view('products.content',[
            'title'=> $product->name,
            'list_thumb'=> json_decode($product->list_image),
            'product'=> $product,
            'products' => $productMore
        ]);
    }
}
