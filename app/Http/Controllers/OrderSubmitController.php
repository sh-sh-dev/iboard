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

        $product = $request->input('product');
        $price = $request->input('price') * 1000;
        $type = $request->input('type');
        $date = strtotime($request->input('date'));
        if (!$date)
            return back()->withInput()->withErrors([
                'date' => __('validation.invalid', ['attribute' => __('validation.attributes.date')])
            ]);

        $order = Order::create([
            'product' => $product,
            'price' => $price,
            'date' => Carbon::createFromTimestamp($date),
            'type' => $type,
        ]);

        return back()->with('message', 'سفارش با شماره ' . $order->id . ' ثبت شد.');
    }
}
