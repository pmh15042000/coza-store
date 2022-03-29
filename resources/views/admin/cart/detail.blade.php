@extends('admin.main')
@section('content')
    <div class="customer mt-3">
        <ul>
            <li>Tên khách hàng: <strong> {{ $customer->name }}</strong></li>
            <li>Số điện thoại: <strong> {{ $customer->phone }}</strong></li>
            <li>Địa chỉ: <strong>{{ $customer->adress }}</strong></li>
            <li>Email: <strong>{{ $customer->email }}</strong></li>
            <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
        </ul>
    </div>
    <div class="carts">
        @php $total = 0; @endphp
        <table class="table">
            <thead>
                <tr>
                    <th class="column-1">Tên sản phẩm</th>
                    <th class="column-2">Image</th>
                    <th class="column-3">Price</th>
                    <th class="column-4">Quantity</th>
                    <th class="column-5">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $key=>$cart)
                    @php
                        $price = $cart->price * $cart->qty;
                        $total += $price;
                    @endphp
                    <tr>
                        <td class="column-1">{{ $cart->product->name }}</td>
                        <td class="column-2">
                            <div class="how-itemcart1">
                                <img style="width:100px" src="{{ asset('/storage/images/products/150/'.$cart->product->image) }}" alt="IMG">
                            </div>
                        </td>
                        <td class="column-3">${{  number_format($cart->price ,0,'','.') }}</td>
                        <td class="column-4">{{ $cart->qty }}</td>
                        <td class="column-5">${{ number_format($price,0,'','.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right"><strong>Tổng tiền: </strong></td>
                    <td><strong>${{ $total }}</strong></td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection