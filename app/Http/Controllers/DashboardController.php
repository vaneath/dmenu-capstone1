<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', auth()->user()?->id)->get()->sortByDesc('order_at');
        $orders->load('restaurant', 'orderItems');
        return Inertia::render('Dashboard/Index',
            [
                'orders' => $orders,
                'user_id' => $user_id,
                'role' => Auth::user()->role,
            ]);
    }
}
