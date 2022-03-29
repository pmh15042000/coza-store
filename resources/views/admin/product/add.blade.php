@extends('admin.main')
@section('head')
<!-- Tiny textarea -->
  <script src="https://cdn.tiny.cloud/1/gm8hyg5lc6c07g8jwnwy2xdj39db7ac63n3ctxnexquqnhk6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('content')
@include('admin.alert')
    <form style="margin: 15px" method="POST" id="add-form" action="" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name">
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
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="intro">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="intro">Chi tiết sản phẩm</label>
            <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{ old('content') }}</textarea>
            @error('content')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group"> 
            
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
        <button type="submit" id="btn-submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
@section('footer')
<script>tinymce.init({ selector:'textarea' });</script>
@endsection