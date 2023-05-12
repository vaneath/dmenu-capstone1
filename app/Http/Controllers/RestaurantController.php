<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('restaurant.index', [
            'restaurants' => Restaurant::where('user_id', Auth::id())->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'currency' => 'required|max:255',
            'no_of_tables' => 'required|max:255',
            'no_of_available_tables' => 'required|max:255'
        ));
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

    public function show(Restaurant $restaurant)
    {
        // get all section but only belongs to the restaurant
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.show', [
            'restaurant' => $restaurant,
            'sections' => $sections,
        ]);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant->user_id == Auth::id()) {
            $restaurant->name = $request->name;
            $restaurant->location = $request->location;
            $restaurant->currency = $request->currency;
            $restaurant->no_of_tables = $request->no_of_tables;
            $restaurant->no_of_available_tables = $request->no_of_available_tables;
            $restaurant->save();
            return redirect()->route('restaurant.index');
        } else {
            return redirect()->route('restaurant.index');
        }
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant->user_id == Auth::id()) {
            $restaurant->delete();
            return redirect()->route('restaurant.index');
        } else {
            return redirect()->route('restaurant.index');
        }
    }
}
