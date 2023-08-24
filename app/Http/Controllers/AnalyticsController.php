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

        return view('analytics', [
            'total' => $orders->count(),
            'sum' => $this->formatPrice($orders->sum('price')),
            'avg' => $this->formatPrice($orders->avg('price')),
            'min' => $this->formatPrice($orders->min('price')),
            'max' => $this->formatPrice($orders->max('price')),
        ]);
    }

    private function formatPrice(int|null $price): string
    {
        return number_format($price) . ' ' . 'تومان';
    }
}
