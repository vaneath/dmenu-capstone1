<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Item;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()?->id)->get();
        $orders->load('restaurant');
        $orders->load('orderItems');

        return Inertia::render('Order/Index',[
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Restaurant::where('id', $request->restaurant_id)->value('user_id');
        // Calculate total order amount
        $total = 0;
        foreach ($request->items as $item) {
            $total += $item['quantity'] * Item::where('id', $item['id'])->value('price');
        }

        $attributes = [
            'id' => Str::random(10),
            'user_id' => $user_id,
            'restaurant_id' => $request->restaurant_id,
            'total' => $total,
        ];

        // dd($attributes['review_expires_at'],$attributes['order_at']);

        $attributes = request()->validate([
            'table_no' => 'required',
        ]);

        $attributes['id'] = Str::random(10);
        $attributes['user_id'] = $user_id;
        $attributes['restaurant_id'] = $request->restaurant_id;
        $attributes['order_at'] = Carbon::now();
        $attributes['review_expires_at'] = Carbon::now()->addHours(24);
        $attributes['total'] = $total;
        $attributes['invoice_qr'] = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=' . $_SERVER['HTTP_ORIGIN'] . '/orders/' . $attributes['id'] . '/qr-pay';
        $order = Order::create($attributes);
        $items = $request->items;

        foreach ($items as $orderDetail) {
            $orderItem = [
                'id' => Str::random(10),
                'user_id' => $user_id,
                'name' => $orderDetail['name'],
                'item_id' => $orderDetail['id'],
                'order_id' => $order['id'],
                'quantity' => $orderDetail['quantity'],
                'amount' => $orderDetail['amount'],
            ];
            $order->orderItems()->create($orderItem);
        }

        return redirect()->route('orders.show', ['order' => $order->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load('restaurant');
        $order->load('orderItems.item');

        $order['invoice_qr'] = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=' . 'http://' . $_SERVER['HTTP_HOST'] . '/api/orders/' . $order['id'] . '/qr-pay';

        return Inertia::render('Invoice/Index', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Show My Order.
     */
    public function showMyOrder(Restaurant $restaurant)
    {
        return Inertia::render('Order/ShowMyOrder', [
            'restaurant' => $restaurant,
        ]);
    }
}
