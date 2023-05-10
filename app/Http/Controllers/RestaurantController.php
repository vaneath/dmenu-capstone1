<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Schema;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurant = new Restaurant();
        $table = $restaurant->getTable();
        $restaurant_columns = Schema::getColumnListing($table);
        $restaurant_columns = array_diff($restaurant_columns, ['created_at', 'updated_at']);
        return view('restaurant.index', [
            'restaurants' => Restaurant::all(),
            'restaurant_columns' => $restaurant_columns
        ]);
    }

    public function store(Request $request)
    {
        //
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
