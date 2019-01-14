<?php

namespace Grundmanis\Laracms\Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Shop\Models\Order;

class OrderController extends Controller
{
    /**
     * @var Order
     */
    private $order;

    /**
     * OrderController constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = $this->order;

        return view('laracms.shop::order.index', [
            'orders' => $orders->paginate(25)
        ]);
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function items(Order $order)
    {
        $items = $order->items;

        return view('laracms.shop::order.items', compact('items'));
    }
}