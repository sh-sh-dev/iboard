@extends('layout.app')

@section('title', 'Register')

@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center">
        <form class="text-center p-4" method="post" action="{{ route('register') }}">
            @csrf
            <h1 class="mb-5">ثبت‌نام</h1>

            <div class="form-floating mb-3">
                <input name="name" type="text" dir="ltr" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                <label>نام</label>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input name="email" type="email" dir="ltr" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                <label>ایمیل</label>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input name="password" type="password" dir="ltr" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                <label>پسورد</label>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-dark" type="submit">تایید</button>
            </div>
        </form>
    </div>
@endsection
