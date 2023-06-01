<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('admin.restaurant.index', [
            'restaurants' => Restaurant::where('user_id', Auth::id())->get(),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'no_of_tables' => 'required|max:255',
            'logo_url' => 'required|image',
            'village' => 'required|max:255',
            'district' => 'required|max:255',
            'commune' => 'required|max:255',
            'province' => 'required|max:255',
        ]);

        $attributes['user_id'] = Auth::id();
        $attributes['id'] = uniqid('dr', true);
        $attributes['logo_url'] = $request->file('logo_url')->store('restaurants/' . $request->name . '/logo');
        Restaurant::create($attributes);

        return redirect()->route('restaurant.index');
    }

    public function show(Restaurant $restaurant)
    {
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('admin.restaurant.show', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('admin.restaurant.show', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else{
            if ($sections->isEmpty()) {
                return view('admin.restaurant.show', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                return view('admin.restaurant.show', [
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

    public function menu($restaurant){
        if(Auth::check()){
            $user = Auth::user();
            $restaurant = $user->restaurants()->where('name', $restaurant)->first();
        }

        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('admin.category.index', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('admin.category.index', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else{
            if ($sections->isEmpty()) {
                return view('admin.category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                return view('admin.category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
    }
}
