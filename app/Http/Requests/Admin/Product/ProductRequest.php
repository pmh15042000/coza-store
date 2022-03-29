<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>    'required',
            'price'=>   'required|numeric',
            'sale_price'=>  'required|numeric',
            'category'=> 'required',
            'brand' => 'required',
            'qty' => 'required|numeric',
            'description'=> 'required',
            'status'=>'required',
            'content'=> 'required',
            'product-thumb'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'files' =>'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function messages()
    {
        return [
            //
            'numeric' => ':attribute phải là số',
            'required' => ':attribute không được để trống',
            'image' => 'Phải là một ảnh',
            'mimes' => 'Ảnh phải thuộc định dạng :mimes',
            'max' => 'Ảnh không được vượt quá :max kb'

        ];
    }
    public function attributes()
    {
        return [
            //
            'name'=> 'Tên sản phẩm',
            'price'=> 'Giá sản phẩm',
            'sale_price'=>  'Giá khuyến mãi',
            'category'=> 'Danh mục',
            'description'=> 'Mô tả',
            'status'=>'Trạng thái',
            'content'=> 'Chi tiết sản phẩm',
            'product-thumb'=> 'Ảnh sản phẩm',
            'files' =>'Ảnh bổ sung',
            'brand' => 'Brand',
            'qty' => 'Số lượng'
        ];
    }
}
