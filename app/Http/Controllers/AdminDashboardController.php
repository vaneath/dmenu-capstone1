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
        $restaurants = Restaurant::withoutGlobalScope('user_id')->get();
        $users = User::all();
        $orders = Order::all()->sortByDesc('created_at');
        $total = OrderItem::all()->sum('amount');

        return view('admin.dashboard', [
            'restaurants' => $restaurants,
            'users' => $users,
            'orders' => $orders,
            'total' => $total,
        ]);
    }
}
