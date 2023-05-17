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
        // dd($request->all());
        // return $request->all();
        // validate the data, if fails, it will redirect to the previous page
        // $this->validate($request, [
        //     'name' => 'required',
        //     'location' => 'required',
        //     'currency' => 'required',
        //     'no_of_tables' => 'required',
        //     'no_of_available_tables' => 'required',
        // ]);

        // $user_id = Auth::id();
        // $restaurant = new Restaurant();
        // $restaurant->name = $request->name;
        // $restaurant->user_id = $user_id;
        // $restaurant->location = $request->location;
        // $restaurant->currency = $request->currency;
        // $restaurant->no_of_tables = $request->no_of_tables;
        // $restaurant->no_of_available_tables = $request->no_of_available_tables;
        // $restaurant->save();
        return $request->all();
    }

    public function show(Restaurant $restaurant)
    {
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('restaurant.show', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('restaurant.show', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else{
            if ($sections->isEmpty()) {
                return view('restaurant.show', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                return view('restaurant.show', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
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
