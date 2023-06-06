<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Section;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('admin.restaurant.show-my-order', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('admin.restaurant.show-my-order', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else {
            if ($sections->isEmpty()) {
                return view('admin.restaurant.show-my-order', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                return view('admin.restaurant.show-my-order', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
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
    public function store(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);

        $cartItems = json_decode($request->cart_items, true);

        $order = Order::create([
            'restaurant_id' => $restaurant->id,
            'id' => uniqid('do', true)
        ]);

        $orderItems = [];

        foreach ($cartItems as $item => $quantity) {
            $item = Item::find($item);
            $orderItem = OrderItem::create([
                'id' => uniqid('oi', true),
                'order_id' => $order->id,
                'item_id' => $item->id,
                'quantity' => $quantity,
                'tax_deduction' => null,
                'discount_amount' => null,
                'amount' => $quantity * $item->price,
            ]);
            array_push($orderItems, $orderItem);
        }

        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        return view('admin.restaurant.checkout', [
            'restaurant' => $restaurant,
            'sections' => $sections,
            'order' => $order,
            'orderItems' => $orderItems,
            'activeSectionPage' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($orderId)
    {
        $order = Order::find($orderId);
        $restaurant = Restaurant::find($order->restaurant_id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('admin.restaurant.checkout', [
            'restaurant' => $restaurant,
            'order' => $order,
            'orderItems' => $orderItems,
            'activeSectionPage' => null,
        ]);
    }

    public function order()
    {
        $orders = Order::all()->sortByDesc('created_at');

        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
}
