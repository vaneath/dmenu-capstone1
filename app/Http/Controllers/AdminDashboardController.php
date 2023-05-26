<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;

class AdminDashboardController
{
    public function __invoke()
    {
        $restaurants = Restaurant::withoutGlobalScope('user_id')->get();
        $users = User::all();

        return view('admin.dashboard', [
            'restaurants' => $restaurants,
            'users' => $users,
        ]);
    }
}
