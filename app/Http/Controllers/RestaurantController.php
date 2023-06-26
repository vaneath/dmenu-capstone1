<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //all restaurants
        $restaurants = Restaurant::where('user_id', Auth::user()->id)->get()->sortByDesc('created_at');

        return Inertia::render('Restaurant/Index', [
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Restaurant/Index', [
            'show' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'table_amount' => 'required|numeric',
            'bg_img_url' => 'required|image',
            'logo_url' => 'required|image',
            'khqr_url' => 'required|image',
            'home_address' => 'required',
            'street_address' => 'required',
            'commune' => 'required',
            'district' => 'required',
        ]);

        if($attributes['name'] == 'Nham'){
            $attributes['id'] = 'FOJjxZ1QaZ';
        } else{
            $attributes['id'] = Str::random(10);
        }
        $attributes['user_id'] = Auth::user()->id;
        $attributes['qr_code_url'] = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=' . $_SERVER['HTTP_ORIGIN'] . '/restaurants/' . $attributes['id'];
        $attributes['bg_img_url'] = $request->file('bg_img_url')->store('restaurants/' . $request->name . '/background');
        $attributes['logo_url'] = $request->file('logo_url')->store('restaurants/' . $request->name. '/logo');
        $attributes['khqr_url'] = $request->file('khqr_url')->store('restaurants/' . $request->name . '/khqr');

        Restaurant::create($attributes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $tags = $restaurant->tags;

        if(!request()->has('tag')) {
            $currentTag = $restaurant->tags->first()?->id;
        } else{
            $currentTag = request('tag');
        }

        $categories = Category::where('tag_id', $currentTag)->get();

        $items = Item::where('category_id', request('category'))->get()->sortByDesc('created_at');

        return Inertia::render('Category/Index', [
            'restaurant' => $restaurant,
            'tags' => $tags,
            'categories' => $categories,
            'currentTag' => $currentTag,
            'items' => $items,
            'showItem' => request()->has('category'),
            'canCreate' => Auth::user()?->id == $restaurant->user_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Restaurant $restaurant)
    {
        dd(request()->all());
        $restaurant->update([
            'name' => request('name') ?? $restaurant->name,
            'table_amount' => request('table_amount') ?? $restaurant->table_amount,
            'home_address' => request('home_address') ?? $restaurant->home_address,
            'street_address' => request('street_address') ?? $restaurant->street_address,
            'commune' => request('commune') ?? $restaurant->commune,
            'district' => request('district') ?? $restaurant->district,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index');
    }
}
