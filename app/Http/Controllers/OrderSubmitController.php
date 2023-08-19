<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class OrderSubmitController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(): \Illuminate\Contracts\View\View
    {
        return view('submit', [
            'products' => Order::$products,
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'product' => ['bail', 'required', Rule::in(Order::$products)],
            'date' => ['bail', 'required', 'string'],
            'price' => ['bail', 'required', 'numeric'],
            'type' => ['bail', 'required', 'in:0,1']
        ]);
        $date = strtotime($request->input('date'));
        if (!$date)
            return back()->withInput()->withErrors([
                'date' => __('validation.invalid', ['attribute' => __('validation.attributes.date')])
            ]);

        $attributes = [
            'product' => $request->input('product'),
            'price' => $request->input('price') * 1000,
            'type' => $request->input('type'),
            'date' => Carbon::createFromTimestamp($date),
        ];
        $duplicates = Order::query()
            ->where($attributes)
            ->select('id')
            ->get();
        $order = Order::create($attributes);

        if ($duplicates->count()) {
            $ids = $duplicates->implode('id', ', ');
            return back()->withInput()->with('message', __('order.duplicate', ['id' => $order->id, 'duplicates' => $ids]));
        }
        else {
            return back()->with('message', __('order.succeed', ['id' => $order->id]));
        }
    }
}
