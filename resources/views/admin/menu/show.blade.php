@extends('admin.main')
@section('content')

@include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px">STT</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th>Slug</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::menu($menus) !!}
        </tbody>    
    </table>    
   
@endsection