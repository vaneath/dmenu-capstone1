<?php

namespace App\Http\Services;

use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use App\Models\Review;
use App\Models\OrderItem;
use Carbon\Carbon;

class StatisticsService
{
    public static function adminStatistics($user_id, $within, $within_type)
    {
        if($within){
            $within = self::minutesBased($within, $within_type);
        }

        $statistics = [];
        $statistics['total_restaurants'] = Restaurant::where('user_id', $user_id)->count();
        $statistics['total_orders'] = Order::where('user_id', $user_id)->count();
        $statistics['total_reviews'] = Review::where('user_id', $user_id)->count();
        $statistics['total_items'] = Item::where('user_id', $user_id)->count();

        $statistics['avg_invoice_total_by_restaurant'] = [];
        $restaurants = Restaurant::where('user_id', $user_id)->get();

        if(!$within){
            $statistics['avg_invoice_total'] = Order::where('user_id', $user_id)->avg('total');
            foreach ($restaurants as $restaurant) {
                $statistics['avg_invoice_total_by_restaurant'][$restaurant->name] = Order::where('restaurant_id', $restaurant->id)->avg('total');
            }

            $statistics['most_ordered_item'] = Item::where('user_id', $user_id)
                ->withCount('orderItems')
                ->orderBy('order_items_count', 'desc')
                ->take(3)
                ->get();

            $statistics['revenue'] = Order::where('user_id', $user_id)->sum('total');
        } else{
            $statistics['avg_invoice_total'] = Order::where('user_id', $user_id)->where('order_at', '>=', Carbon::now()->subMinutes($within))->avg('total');
            foreach ($restaurants as $restaurant) {
                $statistics['avg_invoice_total_by_restaurant'][$restaurant->name] = Order::where('restaurant_id', $restaurant->id)->where('order_at', '>=', Carbon::now()->subMinutes($within))->avg('total');
            }

            $statistics['most_ordered_item'] = Item::where('user_id', $user_id)
                ->withCount(['orderItems' => function ($query) use ($within) {
                    $query->where('order_at', '>=', Carbon::now()->subMinutes($within));
                }])
                ->orderBy('order_items_count', 'desc')
                ->take(3)
                ->get();

            $statistics['revenue'] = Order::where('user_id', $user_id)->where('order_at', '>=', Carbon::now()->subMinutes($within))->sum('total');
        }

        return $statistics;
    }

    public static function superAdminStatistics($user_id, $within, $within_type)
    {
        if($within){
            $within = self::minutesBased($within, $within_type);
        }

        $statistics = [];
        $statistics['total_restaurants'] = Restaurant::count();
        $statistics['total_restaurant_owners'] = User::where('role', 'admin')->count();

        $statistics['revenue_by_restaurant_owner'] = [];
        $users = User::where('role', 'admin')->get();

        if(!$within){
            $statistics['most_ordered_restaurant'] = Restaurant::withCount('orders')->orderBy('orders_count', 'desc')
            ->take(3)
            ->get();

            $statistics['most_ordered_item'] = Item::withCount('orderItems')->orderBy('order_items_count', 'desc')->take(3)->get();

            foreach ($users as $user) {
                $statistics['revenue_by_restaurant_owner'][$user->name] = Order::where('user_id', $user->id)->sum('total');
            }

        } else{
            $statistics['most_ordered_restaurant'] = Restaurant::withCount(['orders' => function ($query) use ($within) {
                $query->where('order_at', '>=', Carbon::now()->subMinutes($within));
            }])->orderBy('orders_count', 'desc')
            ->take(3)
            ->get();

            $statistics['most_ordered_item'] = Item::withCount(['orderItems' => function ($query) use ($within) {
                $query->where('order_at', '>=', Carbon::now()->subMinutes($within));
            }])->orderBy('order_items_count', 'desc')->take(3)->get();

            foreach ($users as $user) {
                $statistics['revenue_by_restaurant_owner'][$user->name] = Order::where('user_id', $user->id)->where('order_at', '>=', Carbon::now()->subMinutes($within))->sum('total');
            }

        }

        foreach ($statistics['most_ordered_item'] as $item) {
            $item->load('category.restaurant');
        }

        return $statistics;
    }

    private static function minutesBased($within, $within_type)
    {
        switch ($within_type) {
            case 'minutes':
                break;
            case 'hours':
                $within = $within * 60;
                break;
            case 'days':
                $within = $within * 60 * 24;
                break;
            case 'weeks':
                $within = $within * 60 * 24 * 7;
                break;
            case 'months':
                $within = $within * 60 * 24 * 30;
                break;
            case 'years':
                $within = $within * 60 * 24 * 365;
                break;
            default:
                $within = null;
                break;
        }
        return $within;
    }
}
