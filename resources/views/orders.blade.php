@extends('layout.app')

@section('title', 'Orders')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="text-center p-4">
        <h3 class="mb-5">لیست سفارش‌ها</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col" width="1">#</th>
                <th scope="col">محصول</th>
                <th scope="col">قطعه آماده</th>
                <th scope="col">قیمت</th>
                <th scope="col">تاریخ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>{{ $order->humanized_product }}</td>
                    <td>{{ $order->type ? '+' : '-' }}</td>
                    <td>{{ $order->humanized_price }}</td>
                    <td>{{ $order->jalali_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection