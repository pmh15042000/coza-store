@extends('admin.main')
@section('content')
@include('admin.alert')
@if ($errors->any())    
<x-alert type='danger' message='Update không thành công!'></x-alert>                       
@endif
    <table class="table">
    <thead>
        <tr>
            <th style="width:50px">STT</th>
            <th>Name</th>
            <th>Thumb</th>
            <th>Creator</th>
            <th>Link</th>
            <th>Active</th>
            <th>Order</th>
            <th>Update at</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if ($slider->count()>0)
        @foreach ($slider as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td><img src="{{ asset('storage/images/sliders/80').'/'.$item->thumb }}" alt=""></td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->url }}</td>
            <td>{!!  \App\Helpers\Helper::format_active($item->active) !!}</td>
            <td>{{ $item->sort }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="javascript:void(0)" type="button" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editSlider({{ $item->id }})"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')" href="slider/delete/{{ $item->id }}"><i class="fas fa-trash-alt"></i></a>    
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
    {{ $slider->appends(request()->all())->links() }}
    <!-- Modal -->
  <div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form style="margin: 15px" method="POST" id="add-form" action="{{ route('slider.update') }}" enctype="multipart/form-data" id="updateSliderForm">
                @csrf
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="old_thumb" name="old_thumb">
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
                    <input type="button" class="btn btn-secondary btn-sm" id="check_thumb" value="Check img">
                    <input type="file" class="form-control" name="product-thumb" id="upload_thumb">
                    <div id="thumb_show"></div>
                    <input type="hidden" name="thumb" id="thumb">
                    @error('thumb')
                            <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Order</label>
                    <input class="form-control" type="number" name="order" value="{{ old('order') }}" id="order">
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
                <button type="submit" id="btn-submit" class="btn btn-primary">Update</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer')
    <script>
        function editSlider(id){
            $.get('slider/getSlider/'+id,function(slider){
                $('#id').val(slider.id);
                $('#old_thumb').val(slider.thumb);
                $('#name').val(slider.name);
                $('#url').val(slider.url);
                $('#order').val(slider.sort);
                $('#thumb_show').html('<img src="http://pmhstore.io/public/storage/images/sliders/80/'+slider.thumb+'">')
                $('input[name="status"]').filter('[value="'+slider.active+'"]').attr('checked', true);
            });
            $('#editSliderModal').modal('toggle');  
        }
    </script>
@endsection