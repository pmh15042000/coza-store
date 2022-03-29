@extends('admin.main')
@section('content')
@section('head')
<!-- Tiny textarea -->
  <script src="https://cdn.tiny.cloud/1/gm8hyg5lc6c07g8jwnwy2xdj39db7ac63n3ctxnexquqnhk6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@include('admin.alert')
@if ($errors->any())    
        <x-alert type='danger' message='Update không thành công!'></x-alert>                       
@endif
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">STT</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Sale</th>
                <th>Catalog</th>
                <th>Active</th>
                <th>Quantily</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
           @if ($products->count()>0)
            @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><img src="{{ asset('storage/images/products/80').'/'.$item->image }}" alt=""></td>
                <td>{{ number_format( $item->price) }}$</td>
                <td>{{ number_format($item->price_sale)  }}$</td>
                <td>{{ $item->menu->name }}</td>
                <td>{!!  \App\Helpers\Helper::format_active($item->active) !!}</td>
                <td>{{ $item->qty }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)" type="button" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editProduct({{ $item->id }})"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')" href="product/delete/{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>    
                </td>
            </tr>
            @endforeach
           @else
            <tr>
                <td colspan="9" class="bg-white text-center">_____________ Data no found___________</td>
            </tr>
           @endif
        </tbody>    
    </table>    
    {{ $products->appends(request()->all())->links() }}
  <!-- Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data" id="updateProductForm">
                @csrf
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="old_thumb" name="old_thumb">
                <input type="hidden" id="old_list_thumb" name="old_list_thumb">
                <div class="form-group">
                    <label for="name"> Tên sản phẩm</label>
                    <input type="text" name="name" id="name" class="form-control">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input class="form-control" type="text" value="{{ old('price') }}" name="price" id="price">
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sale-price"> Giá khuyến mãi</label>
                    <input class="form-control" type="text" value="{{ old('sale_price') }}" name="sale_price" id="sale-price">
                    @error('sale_price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="qty"> Số lượng</label>
                    <input class="form-control" type="text" value="{{ old('qty') }}" name="qty" id="qty">
                    @error('qty')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                        <label for="intro">Mô tả sản phẩm</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{ old('content') }}</textarea>
                    @error('content')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh sản phẩm <span style="color:red">(* Bấm check để upload ảnh)</span></label>
                    <input type="button" class="btn btn-secondary btn-sm" id="check_thumb" value="Check img">
                    <input type="file" class="form-control" name="product-thumb" id="upload_thumb">
                    <div id="thumb_show"></div>
                    <input type="hidden" name="thumb" id="thumb">
                    @error('product-thumb')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div  class="mb-3">
                    <label class="form-label">Ảnh khác  <span style="color:red">(* Bấm check để upload ảnh)</span></label>
                    <input type="button" class="btn btn-secondary btn-sm" id="check_sub_img" value="Check list img">
                    <input type="file" class="form-control" name="files[]" id="sub_thumbs" multiple/>
                    <div id="sub_thumb_show"></div>
                    <input type="hidden" name="sub_img" id="sub_img">
                    @error('files')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @error('files.*')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Danh mục</label>
                    <select class="form-control" name="category" id="category-dropdown">
                        <option value="">Chọn danh mục</option>
                    @foreach ($menu as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                    </select>
                    @error('category')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Thương hiệu</label>
                    <select class="form-control" name="brand" id="sub-category-dropdown">
                        <option value="">Chọn thương hiệu</option>
                    </select>
                    @error('brand')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" id="active" name="status" checked="">
                    <label for="active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" id="disable" type="radio" value="0" name="status" >
                    <label for="disable" class="form-check-label">Disable</label>
                    </div>
                </div>
                <button type="submit" id="btn-submit" class="btn btn-primary"> Update</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer')
<script>tinymce.init({ selector:'textarea' });</script>
<script>
    function editProduct(id){
        $.get('product/getProduct/'+id,function(product){
                    $('#id').val(product.id);
                    $('#name').val(product.name);
                    $('#price').val(product.price);
                    $('#sale-price').val(product.price_sale); 
                    $('#qty').val(product.qty);  
                    $('#old_thumb').val(product.image);
                    $('#old_list_thumb').val(product.list_image);
                    $('#category-dropdown').val(product.menu.parent_id).change();
                    $('#sub-category-dropdown').val(product.menu.id).change();
                    tinymce.get("description").setContent(product.description);
                    tinymce.get("content").setContent(product.content);
                    $('input[name="status"]').filter('[value="'+product.status+'"]').attr('checked', true);
                    $('#thumb_show').html('<img src="http://pmhstore.io/public/storage/images/products/80/'+product.image+'">');
                    var sub_thumb= '<ul class="list-inline d-flex">';
                    var list_thumb= jQuery.parseJSON(product.list_image);
                    $.each(list_thumb,function(key,value){
                        sub_thumb += '<li><img src="http://pmhstore.io/public/storage/images/products/80/'+value+'"></li>';
                    });
                    sub_thumb += '</ul>';
                    $('#sub_thumb_show').html(sub_thumb);
                    $('#editProductModal').modal('toggle');        
            });
    }
    
</script>
@endsection