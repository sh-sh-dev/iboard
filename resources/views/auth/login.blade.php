@extends('layout.app')

@section('title', 'Login')

@section('content')
    <div class="h-100 d-flex align-items-center justify-content-center mt-4">
        <form class="text-center p-4 bg-dark rounded-3 shadow" method="post" action="{{ route('login') }}">
            @csrf
            <h3 class="mb-5 text-light">ورود</h3>

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

            <input name="remember" value="true" type="hidden">

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-outline-danger" type="submit">تایید</button>
            </div>
        </form>
    </div>
@endsection
