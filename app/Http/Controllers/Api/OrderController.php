<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query params
        $user_id = request()->query('user_id');
        $orders = Order::where('user_id', $user_id)->orderBy('order_at', 'desc')->get();

        $orders->load('restaurant');
        $orders->load('orderItems');

        // return response()->json([
        //     'orders' => $orders,
        // ]);

        return response()->json([
            'user_id' => $user_id,
            'orders' => $orders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get payment status.
     */
    public function paymentStatus(Order $order)
    {
        return response()->json([
            'payment_status' => $order->payment_status,
        ]);
    }

    /**
     * Qr pay.
     */
    public function qrPay(Order $order)
    {
        $order->payment_status = 'paid';
        $order->save();
        return Inertia::render('Payment/Success');
    }
}
