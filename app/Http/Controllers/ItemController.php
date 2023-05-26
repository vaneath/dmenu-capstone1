<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\Section;

class ItemController extends Controller
{
    // Route::get('categories/{category}/items', [ItemController::class, 'index'])->name('item.index');
    public function index(Restaurant $restaurant, $category)
    {
        return view('admin.restaurant.show-items', [
            'category' => $category,
            'items' => $category->items,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all(), $request->name, $request->category_id, $request->description, $request->img_url, $request->price, $request->old_price, $request->weight, $request->is_available, $request->is_visible);
        $category = Category::find($request->category_id);
        $max_sort_number = Item::where('category_id', $request->category_id)->max('sort_number');
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->img_url = $request->img_url;
        $item->price = $request->price;
        $item->old_price = $request->old_price;
        $item->weight = $request->weight;
        $item->category_id = $request->category_id;
        do {
            $item->unique_id = uniqid('di', true);
            $unique_id = Item::where('unique_id', $item->unique_id)->first();
        } while ($unique_id != null);
        $item->is_available = $request->is_available === 'on' ? true : false;
        $item->is_visible = $request->is_visible === 'on' ? true : false;
        $item->sort_number = $max_sort_number + 1;
        $item->save();


        return redirect()->route('restaurant.menu', [
            'restaurant' => $category->section->restaurant,
            'sections' => $category->section->restaurant->sections,
            'active-section-id' => $category->section->id,
        ]);
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
