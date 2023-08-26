<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class AnalyticsController extends BaseController
{
    public function index(): \Illuminate\Contracts\View\View
    {
        // @TODO: reduce queries
        return view('analytics', [
            'cards' => $this->getCardsData(),
            'orders' => $this->getProductsAveragePrices(),
            'chart' => $this->getChartData(),
        ]);
    }

    private function getCardsData(): array
    {
        $orders = Order::query()
            ->select('price')
            ->get();

        return [
            'count' => $orders->count(),
            'sum' => $this->formatPrice($orders->sum('price')),
            'avg' => $this->formatPrice($orders->avg('price')),
        ];
    }

    public function getProductsAveragePrices(): Collection
    {
        return Order::query()
            ->select([
                'product',
                'type',
                DB::raw('AVG(`price`) as average_price'),
                DB::raw('COUNT(`id`) as repeat_count'),
            ])
            ->groupBy('product', 'type')
            ->orderBy('product')
            ->get();
    }

    private function getChartData(): Collection
    {
        $data = Order::query()
            ->select([
                DB::raw('DATE(`date`) as date'),
                DB::raw('COUNT(`id`) as count'),
            ])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn($item) => [
                'date' => Jalalian::fromCarbon(Carbon::create($item['date']))->format('Y F'),
                'count' => $item['count'],
            ]);

        if ($data->duplicates('date')->isNotEmpty())
            $data = collect($data->groupBy('date')->map(fn($items) => [
                'date' => $items->first()['date'],
                'count' => $items->sum('count'),
            ])->values()->all());

        return $data;
    }

    private function formatPrice(int|null $price): string
    {
        return number_format($price) . ' ' . 'تومان';
    }
}
