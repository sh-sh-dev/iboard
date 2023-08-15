@extends('layout.app')

@section('title', 'Submit Order')

@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center">
        <form class="text-center p-4" method="post" action="{{ route('submit.form') }}">
            @csrf
            <h3 class="mb-5">ثبت سفارش</h3>

            @if (session('message'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-floating mb-3">
                <select name="product" id="products" class="form-control" dir="ltr">
                    @foreach($products as $product)
                        <option>{{ $product }}</option>
                    @endforeach
                </select>
                <label>محصول</label>

                @error('product')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input name="price" type="number" dir="ltr" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                <label>مبلغ</label>

                @error('price')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input name="date" dir="ltr" class="form-control @error('date') is-invalid @enderror"
                       value="{{ old('date') }}">
                <label>تاریخ</label>

                @error('date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <select name="type" class="form-control">
                    <option value="0">آی‌بورد</option>
                    <option value="1">مشتری</option>
                </select>
                <label>تامین قطعه</label>

                @error('type')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-dark" type="submit">ثبت</button>
            </div>
        </form>
    </div>
@endsection
