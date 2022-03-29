<?php 
namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
class CartComposer{
    public function __construct()
    {
   
    }
    public function compose(View $view){
        $carts= Session::get('carts');
        if(is_null($carts)) return [];
        $productID = array_keys($carts);
        $products= Product::select('id','name','price','price_sale','image')
        ->where('active',1)
        ->whereIn('id',$productID)
        ->get();
        $view->with('products',$products);
    }
}

?>