<?php
namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
class ProductService{
    function getAll(){
        return Product::with('menu:name,id')->orderBy('id')->paginate(3);
    }
    function getProductByID($id){
        return Product::with('menu:name,id,parent_id')->find($id);
    }
    function store($request){
        try{
            Product::create([
                'name'=> $request->input('name'),
                'menu_id'=> $request->input('brand'),
                'price_sale'=> $request->input('sale_price'),
                'description'=> $request->input('description'),
                'content'=> $request->input('content'),
                'image'=> $request->input('thumb'),
                'price'=> $request->input('price'),
                'list_image'=> $request->input('sub_img'),
                'active'=> $request->input('status'),
                'qty'=> $request->input('qty'),
            ]);
            Session::flash('success','Thêm danh mục thành công');
        }catch(\Exception $error){
            Session::flash('error',$error->getMessage());
            return false;
        }
    }
    function update($request){
        try{
            if($request->input('thumb')== ''){
                $image= $request->input('old_thumb');
            }else{
                $image= $request->input('thumb');
            }
            if($request->input('sub_img')== ''){
                $sub_image= $request->input('old_list_thumb');
            }else{
                $sub_image= $request->input('sub_img');
            }
            Product::where('id',$request->id)
            ->update([
                    'name' => $request->name,
                    'image'=> $image,
                    'price'=> $request->price,
                    'price_sale'=> $request->sale_price,
                    'description' => $request->description,
                    'content' => $request->content,
                    'qty' => $request->qty,
                    'list_image'=> $sub_image,
                    'active'=>$request->status,
                    'menu_id' => $request->brand,
            ]);
            Session::flash('success','Update thành công');
        }catch(\Exception $error){
            Session::flash('error',$error->getMessage());
            return false;
        }
       
    }

     function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return  true;
    }
    function destroy($id){
       $pr= Product::find($id);
        if($pr){
            return $pr->delete();
        }
        return false;
    }

}
?>