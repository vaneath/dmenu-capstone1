<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\Item;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function index(Restaurant $restaurant, Order $order){

        $error = [];

        if($order->review()->exists()){
            $error['message'] = 'Order already reviewed.';
        } elseif ($order->review_expires_at < Carbon::now()) {
            $error['message'] = 'Order\'s review period is past.';
        }

        if (!empty($error)) {
            return Inertia::render('Review/Unavailable', [
                'error' => $error,
                'go_back_uri' => route('orders.show', ['order' => $order->id]),
                'restaurant_id' => $restaurant->id,
            ]);
        }

        // get items from orderitems
        $order->load('orderItems');
        $items = [];
        foreach ($order->orderItems as $orderItem) {
            $item = Item::find($orderItem->item_id);
            array_push($items, $item);
        }

        return Inertia::render('Review/Index', [
            'restaurant' => $restaurant,
            'order' => $order,
            'restaurant_id' => $restaurant->id,
            'order_id' => $order->id,
            'items' => $order->orderItems,
            'go_back_uri' => route('orders.show', ['order' => $order->id]),
        ]);
    }

    public function show(Restaurant $restaurant, Order $order, Review $review){
        return Inertia::render('Review/Show', [
            'review' => $review,
        ]);
    }

    public function store(Request $request){

        $order = Order::find($request->order);

        if($order->review()->exists()){
            return redirect()->route('orders.show', ['order' => $order->id]);
        } elseif ($order->review_expires_at < Carbon::now()) {
            return redirect()->route('orders.show', ['order' => $order->id]);
        }

        $attributes = $request->review;

        $attributes['id'] = Str::random(10);
        $attributes['user_id'] = $order->user_id;
        $attributes['restaurant_id'] = $request->restaurant;
        $attributes['order_id'] = $request->order;

        $review = Review::create($attributes);

        return redirect()->route('orders.show', ['order' => $request->order]);
    }

    // manage reviews
    public function manage(){
        $user = auth()->user();
        $reviews = Review::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        $reviews->load('restaurant');
        $reviews->load('order');

        return Inertia::render('Review/Manage', [
            'user_id' => $user->id,
            'reviews' => $reviews,
            'restaurants' => Restaurant::where('user_id', $user->id)->get(),
        ]);
    }
}
