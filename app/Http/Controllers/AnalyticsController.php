<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends BaseController
{
    public function index(): \Illuminate\Contracts\View\View
    {
        // @TODO: reduce queries
        return view('analytics', [
            'cards' => $this->getCardsData(),
            'orders' => $this->getProductsAveragePrices(),
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

    public function getProductsAveragePrices(): \Illuminate\Database\Eloquent\Collection
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

    private function formatPrice(int|null $price): string
    {
        return number_format($price) . ' ' . 'تومان';
    }
}
