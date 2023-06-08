<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::withoutGlobalScope('user_id')->get();
        $users = User::all();

        return view('superadmin.index', [
            'restaurants' => $restaurants,
            'users' => $users,
        ]);
    }

    public function users()
    {
        $users = User::all();

        return view('superadmin.users', [
            'users' => $users,
        ]);
    }


    public function restaurants()
    {
        $restaurants = Restaurant::all();
        //count total income of each restaurant
        foreach ($restaurants as $restaurant) {
            $total = 0;
            foreach ($restaurant->orders as $order) {
                foreach ($order->orderItems as $orderItem) {
                    $total += $orderItem->amount;
                }
            }
        }

        return view('superadmin.restaurants', [
            'restaurants' => $restaurants,
            'total' => $total ?? 0,
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
