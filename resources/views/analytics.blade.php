@extends('layout.app')

@section('title', 'Analytics')

@section('content')
    <div class="m-4 shadow">
        <div class="p-3 bg-dark text-light rounded-3">
            <h3 class="ms-2">آمار</h3>
            <hr>
            <div class="card-group justify-content-center mb-3">
                <div class="card text-white bg-dark m-3 shadow-sm" style="max-width: 15rem">
                    <div class="card-header text-muted">تعداد</div>
                    <div class="card-body">
                        <h5 class="card-body text-center">{{ $cards['count'] }}</h5>
                    </div>
                </div>
                <div class="card text-white bg-dark m-3 shadow-sm" style="max-width: 15rem">
                    <div class="card-header text-muted">سرجمع</div>
                    <div class="card-body">
                        <h5 class="card-body text-center">{{ $cards['sum'] }}</h5>
                    </div>
                </div>
                <div class="card text-white bg-dark m-3 shadow-sm" style="max-width: 15rem">
                    <div class="card-header text-muted">میانگین</div>
                    <div class="card-body">
                        <h5 class="card-body text-center">{{ $cards['avg'] }}</h5>
                    </div>
                </div>
            </div>
            <div id="chart"></div>
            <hr>
            <h5 class="ms-2">فروش محصولات</h5>
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="table-responsive-md">
                        <table class="table p-5 table-dark text-center table-hover">
                            <thead>
                            <tr>
                                <th scope="col" width="30%">محصول</th>
                                <th scope="col" width="10%">قطعه آماده</th>
                                <th scope="col" width="10%">تعداد</th>
                                <th scope="col" width="30%">میانگین قیمت فروش</th>
                                <th scope="col" width="10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $product)
                                <tr>
                                    <td>{{ $product->humanized_product }}</td>
                                    <td>{{ $product->humanized_type }}</td>
                                    <td>{{ $product->repeat_count }}</td>
                                    <td>{{ number_format($product->average_price) }}</td>
                                    <td>
                                        <a href="{{ route('orders.list', ['sort' => 'date-asc', 'product' => $product->product, 'type' => $product->type]) }}"
                                           class="btn btn-outline-secondary btn-sm">مشاهده</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', () => {
            let chart = new ApexCharts(document.querySelector("#chart"), {
                theme: {
                    mode: 'dark'
                },
                chart: {
                    type: 'line',
                    height: 400,
                    zoom: {
                        enabled: false,
                    },
                    fontFamily: 'Vazirmatn',
                },
                stroke: {
                    curve: 'smooth',
                },
                series: [
                    {
                        data: {!! $chart->pluck('count') !!},
                        name: 'سفارش',
                    },
                ],
                xaxis: {
                    categories: {!! $chart->pluck('date') !!}
                },
            });
            chart.render();
        });
    </script>
@endsection
