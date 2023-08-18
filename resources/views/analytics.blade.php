@extends('layout.app')

@section('title', 'Analytics')

@section('content')
    <div class="m-4 shadow">
        <div class="p-3 bg-dark text-light rounded-3">
            <h3 class="ms-2">آمار</h3>
            <div class="table-responsive-md">
                <table class="table p-5 table-dark text-center table-hover">
                    <thead>
                    <tr>
                        <th scope="col" width="50%"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>تعداد</td>
                        <td>{{ $total }}</td>
                    </tr>
                    <tr>
                        <td>جمع</td>
                        <td>{{ $sum }}</td>
                    </tr>
                    <tr>
                        <td>میانگین</td>
                        <td>{{ $avg }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection
