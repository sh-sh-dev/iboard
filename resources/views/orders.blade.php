@extends('layout.app')

@section('title', 'Orders')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="m-4 shadow">
        <div class="p-3 bg-dark text-light rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-toolbar">
                    <h3 class="ms-2">
                        لیست سفارش‌ها
                        <span>({{ $orders->count() }})</span>
                    </h3>
                </div>
                <div class="justify-content-end row">
                    <form class="col-12" method="get" id="sortForm">
                        <label class="m-2 text-muted align">ترتیب:</label>
                        <label>
                            <select id="sort" name="sort" oninput="document.getElementById('sortForm').submit()" class="form-control bg-dark text-light border-secondary text-center">
                                <option value="id-asc">شماره - قدیم</option>
                                <option value="id-desc">شماره - جدید</option>
                                <option value="date-asc">تاریخ - قدیم</option>
                                <option value="date-desc">تاریخ - جدید</option>
                                <option value="price-asc">قیمت - کم</option>
                                <option value="price-desc">قیمت - زیاد</option>
                            </select>
                        </label>
                    </form>
                </div>
            </div>
            <hr>
            <div class="table-responsive-md">
                <table class="table p-5 table-dark text-center table-hover">
                    <thead>
                    <tr>
                        <th scope="col" width="1">#</th>
                        <th scope="col">محصول</th>
                        <th scope="col">قطعه آماده</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th scope="row" title="{{ $order->id }}">{{ $loop->iteration }}</th>
                            <td>{{ $order->humanized_product }}</td>
                            <td>{{ $order->humanized_type }}</td>
                            <td>{{ $order->humanized_price }}</td>
                            <td>{{ $order->jalali_date }}</td>
                            <td><a class="btn btn-outline-danger btn-sm delete" onclick="confirm('Are you sure?') || event.preventDefault()" href="{{ route('orders.delete', $order) }}">حذف</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('sort').value = '{{ $sort }}';
    </script>
@endsection
