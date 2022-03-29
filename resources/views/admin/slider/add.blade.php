@extends('admin.main')
@section('content')
@include('admin.alert')
    <form style="margin: 15px" method="POST" id="add-form" action="" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name">Tên slider</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" id="name">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="name">Slug</label>
                    <input class="form-control" type="text" name="url" value="{{ old('url') }}" id="url">
                    @error('url')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm <span style="color:red">(* Bấm check để upload ảnh)</span></label>
            <input type="button" class="btn btn-secondary btn-sm" id="check_slider" value="Check img">
            <input type="file" class="form-control" name="slider_thumb" id="upload_thumb">
            <div id="thumb_show"></div>
            <input type="hidden" name="thumb" id="thumb">
            @error('thumb')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Order</label>
            <input class="form-control" type="number" name="order" value="{{ old('order') }}" id="order ">
            @error('order')
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