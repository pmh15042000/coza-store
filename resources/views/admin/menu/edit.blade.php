@extends('admin.main')
@section('head')
<!-- Tiny textarea -->
  <script src="https://cdn.tiny.cloud/1/gm8hyg5lc6c07g8jwnwy2xdj39db7ac63n3ctxnexquqnhk6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('content')
@include('admin.alert')
<form action="" method="POST">
    @csrf
    <div class="card-body">
     <!-- name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $menu->name }}" id="name" placeholder="Enter menu name">
        @error('name')
            <div class=" text-danger">{{ $message }}</div>
        @enderror
      </div>
     
     <!-- parent menu -->
      <div class="form-group">
        <label>Parent Menu</label>
        <select class="form-control" name="parent_id" >
          <option value="0"{{ $menu->parent_id==0 ? 'selected': '' }}>---Choose---</option>
          @foreach ($menus as $item)
              <option value="{{ $item->id }}" {{ $menu->parent_id==$item->id ? 'selected': '' }}> {{ $item->name}}</option>
          @endforeach
        </select>
      </div>
      
     <!-- description -->
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" name="description">{{ $menu->description }}</textarea>
        @error('description')
            <div class=" text-danger">{{ $message }}</div>
        @enderror
      </div>
     <!-- content -->
      <div class="form-group">
        <label>Content</label>
        <textarea class="form-control" id="content" name="content"> {{ $menu->content }}</textarea>
        @error('content')
            <div class=" text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Ảnh mô tả <span style="color:red">(* Bấm check để upload ảnh)</span></label>
        <input type="button" class="btn btn-secondary btn-sm" id="check_thumb_menu" value="Check img">
        <input type="file" class="form-control" name="menu-thumb" id="upload_thumb">
        <div id="thumb_show">
          <a href=""><img src="{{ asset('/storage/images/menus/150/'.$menu->thumb) }}" alt=""></a>
        </div>
        <input type="hidden" name="thumb" id="thumb" value="{{ $menu->thumb }}">
        @error('menu-thumb')
                <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
     <!-- status -->
      <div class="form-group">
        <label for="">Status</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" value="1" id="active" name="status" {{ $menu->active==1 ? 'checked': '' }}>
          <label for="active" class="form-check-label">Active</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" id="disable" type="radio" value="0" name="status" {{ $menu->active==0 ? 'checked': '' }}>
          <label for="disable" class="form-check-label">Disable</label>
        </div>
      </div>
    </div>

    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Add submit</button>
    </div>
</form>
@endsection

@section('footer')
<script>tinymce.init({ selector:'textarea#content' });</script>
@endsection