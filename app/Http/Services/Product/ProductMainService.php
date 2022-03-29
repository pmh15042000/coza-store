<?php
namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
class ProductMainService{
    const LIMIT = 16;
    function get($page = null){
        return Product::select('id','name','price','price_sale','image')
        ->orderByDesc('id')
        ->when($page != null, function ($query) use ($page){
            $query->offset($page*self::LIMIT);
        })
        ->limit(self::LIMIT)
        ->get();
    }
    function getPro($pr,$request){
        $query= Product::whereIn('menu_id',$pr)->where('active',1);
        if($request->input('price')){
            $query->orderBy('price',$request->input('price'));
        }
        return $query->orderByDesc('id')->paginate(12)->withQueryString();
    }
    function show($id){
        return Product::where('id',$id)->with('menu')->where('active',1)->firstOrFail();
    }
    function getMore($id){
        return Product::select('id','name','price','price_sale','image')
        ->where('id','!=',$id)
        ->limit(8)
        ->orderByDesc('id')
        ->get();
    }
    function addView($id){
     return Product::find($id)->increment('views');

    }
}
?>