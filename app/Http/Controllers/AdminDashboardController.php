<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\User;

class AdminDashboardController
{
    public function __invoke()
    {
        $total = 0;

        $restaurants = Restaurant::where('user_id', auth()->user()->id)->get();
        $users = User::all();
        $orders = Order::where('user_id', auth()->user()->id)->get()->sortByDesc('created_at');
        foreach ($orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                $total += $orderItem->amount;
            }
        }

        return view('admin.dashboard', [
            'restaurants' => $restaurants,
            'users' => $users,
            'orders' => $orders,
            'total' => $total,
        ]);
    }
}
