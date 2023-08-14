<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@hasSection('title'){{ env('APP_NAME') }} - @yield('title')@else{{ env('APP_NAME') }}@endif</title>
    @vite('resources/css/app.css')
</head>
<body dir="rtl" style="overflow-x: hidden">
@include('layout.navbar')
<div id="app">
    <div class="container-fluid">
        <div class="h-100 d-flex align-items-center justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
