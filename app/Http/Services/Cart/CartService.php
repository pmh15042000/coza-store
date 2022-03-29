<?php 
namespace App\Http\Services\Cart;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService {
    public function create($request){
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');
        if($qty<=0 || $product_id <=0){
            Session::flash('error','Số lượng hoặc sản phẩm không chính xác');
            return false;
        }
        $carts = Session::get('carts');
        if(is_null($carts)){
            Session::put('carts',[
                $product_id => $qty
            ]);
            return true;
        }
        $exists=Arr::exists($carts, $product_id);
        if($exists){
            $qtyNew  = $carts[$product_id] + $qty;
            Session::put('carts',[$product_id => $qtyNew ]);
            return true;
        }
        $carts[$product_id]= $qty;
        Session::put('carts',$carts);
        return true;
    }
    public function getProduct(){
        $carts= Session::get('carts');
        if(is_null($carts)) return [];
        $productID = array_keys($carts);
        return Product::select('id','name','price','price_sale','image')
        ->where('active',1)
        ->whereIn('id',$productID)
        ->get();
    }
    public function update($request){
        Session::put('carts',$request->input('num_product'));
        return true;
    }
    public function remove($id){
       $carts= Session::get('carts');
        unset($carts[$id]);
        Session::put('carts',$carts);
        return true;
    }
    public function addCart($request){
        try{
            DB::beginTransaction();
            $carts = Session::get('carts');
            if(is_null($carts)) return false;
            $customer =  Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'adress' => $request->input('address'),
                'content'=> $request->input('content')
            ]);
            $this->infoProductCart($carts,$customer->id);
            DB::commit();
            Session::flash('success', 'Đặt hàng thành công');
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(5));
            Session::forget('carts');
        }catch(\Exception $err){
            DB::rollBack();
            Session::flash('error',$err);
            return false;
        }
    }
    public function infoProductCart($carts,$customer){
            $productID =array_keys($carts);
            $products = Product::select('id','name','price','price_sale','image')
            ->where('active',1)
            ->whereIn('id',$productID)
            ->get();
            $data=[];
            foreach($products as $product){
                $data=[
                    'customer_id' => $customer,
                    'product_id' => $product->id,
                    'qty' => $carts[$product->id],
                    'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
                ];
                Cart::insert($data);
            }
            return true;    
    }
    function getCustomer(){
        return Customer::orderBy('id')->paginate(5);       
    }
    function getProductForCart($customer){
        return $customer->carts()->with(['product'=>function($query){
            $query->select('id','name','image');
        }])->get();
    }
    function total_qty_by_date($date){
        return Cart::whereDate('created_at',$date)->sum('qty');
    }
}
?>