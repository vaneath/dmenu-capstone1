<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = new Restaurant();
        $tables = $restaurants->getTable();
        $restaurant_columns = Schema::getColumnListing($tables);
        $restaurant_columns = array_diff($restaurant_columns, ['created_at', 'updated_at']);
        return view('restaurant.index', [
            'restaurants' => Restaurant::all(),
            'restaurant_columns' => $restaurant_columns
        ]);
        // only for is_visible set to true
        // return view('restaurant.index', [
        //     'restaurants' => Restaurant::where('is_visible', true)->get(),
        //     'restaurant_columns' => $restaurant_columns
        // ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $user_id = Auth::id();
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->user_id = $user_id;
        $restaurant->location = $request->location;
        $restaurant->currency = $request->currency;
        $restaurant->no_of_tables = $request->no_of_tables;
        $restaurant->no_of_available_tables = $request->no_of_available_tables;
        $restaurant->save();
        return redirect()->route('restaurant.index');
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
