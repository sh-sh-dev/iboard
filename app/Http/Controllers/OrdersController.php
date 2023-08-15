<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Routing\Controller as BaseController;

class OrdersController extends BaseController
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $orders = Order::query()
            ->select(['id', 'product', 'price', 'type', 'date'])
            ->get();

        return view('orders', [
            'orders' => $orders
        ]);
    }
}
