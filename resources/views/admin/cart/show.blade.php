@extends('admin.main')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Ngày đặt hàng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer as $cus)
               <tr>
                    <td>{{ $cus->id }}</td>
                    <td>{{ $cus->name }}</td>
                    <td>{{ $cus->phone }}</td>
                    <td>{{ $cus->email }}</td>
                    <td>{{ $cus->created_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/cart/view/{{ $cus->id }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-danger btn-sm" onclick="" href="#"><i class="fas fa-trash-alt"></i></a>
                    </td>
               </tr>
            @endforeach
        </tbody>
    </table>
    <div class="cart-footer clearfix">
        {{ $customer->links() }}
    </div>
@endsection