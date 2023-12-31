<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;

class OrdersController extends BaseController
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $request->validate([
            'sort' => ['bail', 'nullable', Rule::in($this->getAvailableSortOptions())],
            'product' => ['bail', 'nullable', Rule::in(Order::$products)],
            'type' => ['bail', 'nullable', 'in:0,1'],
        ]);
        $sortBy = $request->filled('sort')
            ? explode('-', $request->input('sort'))
            : ['id', 'asc'];

        $orders = Order::query()
            ->select(['id', 'product', 'price', 'type', 'date'])
            ->orderBy($sortBy[0], $sortBy[1]);

        if ($request->filled('product'))
            $orders = $orders->where('product', $request->input('product'));
        if ($request->filled('type'))
            $orders = $orders->where('type', $request->input('type'));

        $orders = $orders->get();

        return view('orders', [
            'orders' => $orders,
            'sort' => implode('-', $sortBy),
        ]);
    }

    public function destroy(Order $order): \Illuminate\Http\RedirectResponse
    {
        $order->delete();

        return back();
    }

    private function getAvailableSortOptions(): array
    {
        $result = [];
        $columns = [
            'id',
            'date',
            'price',
        ];

        foreach ($columns as $column) {
            $result[] = $column . '-' . 'asc';
            $result[] = $column . '-' . 'desc';
        }

        return $result;
    }
}
