<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        $users->load('restaurants');

        $restaurants = Restaurant::all();
        $restaurants->load('orders', 'user');

        $orders = Order::all()->sortByDesc('created_at')->take(10);
        $orders->load('restaurant', 'orderItems');

        $allOrders = Order::all()->count();

        return Inertia::render('SuperAdmin/Dashboard', [
            'users' => $users,
            'allOrders' => $allOrders,
            'restaurants' => $restaurants,
            'user_id' => auth()->user()->id,
            'orders' => $orders
        ]
    );
    }

    public function users()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        $users->load('restaurants');

        return Inertia::render('SuperAdmin/Users', [
            'users' => $users,
        ]);
    }

    public function restaurants()
    {
        $restaurants = Restaurant::all();

        return Inertia::render('SuperAdmin/Restaurants', [
            'restaurants' => $restaurants,
        ]);
    }

    public function orders()
    {
        $orders = Order::all()->sortByDesc('created_at');
        $orders->load('restaurant');
        $orders->load('orderItems');

        return Inertia::render('SuperAdmin/Orders', [
            'orders' => $orders,
        ]);
    }
}
