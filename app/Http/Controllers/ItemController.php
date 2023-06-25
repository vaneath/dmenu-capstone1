<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store()
    {
//        dd(request()->all());
        $attributes = request()->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'img_url' => 'required|image',
            'is_available' => 'required|boolean',
            'category_id' => 'required',
        ]);

        $attributes['id'] = Str::random(10);
        $attributes['user_id'] = auth()->user()->id;
        $attributes['img_url'] = request()->file('img_url')->store('categories/' . Category::where('id', $attributes['category_id'])->first()->name . '/items' );

        Item::create($attributes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('restaurants.categories.show', [
            'restaurant' => $item->category->restaurant->id, 
            'category' => $item->category->id
        ]);
    }
}
