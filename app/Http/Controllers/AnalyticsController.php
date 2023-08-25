<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Routing\Controller as BaseController;

class AnalyticsController extends BaseController
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $orders = Order::query()
            ->select('price')
            ->get();

        $averagePrices = $this->getProductsAveragePrices();

        return view('analytics', [
            'cards' => [
                'count' => $orders->count(),
                'sum' => $this->formatPrice($orders->sum('price')),
                'avg' => $this->formatPrice($orders->avg('price')),
            ],
            'orders' => $averagePrices,
        ]);
    }

    public function getProductsAveragePrices(): \Illuminate\Database\Eloquent\Collection
    {
        return Order::query()
            ->selectRaw('product, type, AVG(price) as average_price, COUNT(*) as repeat_count')
            ->groupBy('product', 'type')
            ->orderBy('product')
            ->get();
    }

    private function formatPrice(int|null $price): string
    {
        return number_format($price) . ' ' . 'تومان';
    }
}
