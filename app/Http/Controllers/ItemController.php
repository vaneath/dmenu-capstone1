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
//        dd($request->all());
        $category = Category::find($request->category_id);
        $section = Section::find($category->section_id);
        $restaurant = Restaurant::find($section->restaurant_id);

//        dd($request->all());

        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'menu_img_url' => 'required|image',
            'price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'weight' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $attributes['discount'] = $request->discount_price;
        $attributes['img_url'] = $request->file('menu_img_url')->store('restaurants/' . $restaurant->name . '/items');
        $attributes['is_available'] = $request->is_available === 'on' ? true : false;
        $attributes['sort_number'] = Item::where('category_id', $request->category_id)->max('sort_number') + 1;
        $attributes['id'] = uniqid('di', true);
        Item::create($attributes);

        return redirect()->route('restaurant.menu', [
            'restaurant' => $restaurant,
            'sections' => $section,
            'active-section-id' => $section->id,
        ]);


//        $category = Category::find($request->category_id);
//        $max_sort_number = Item::where('category_id', $request->category_id)->max('sort_number');
//        $item = new Item();
//        $item->name = $request->name;
//        $item->description = $request->description;
//        $item->img_url = $request->img_url;
//        $item->price = $request->price;
//        $item->discount = $request->discount;
//        $item->weight = $request->weight;
//        $item->category_id = $request->category_id;
//        do {
//            $item->id = uniqid('di', true);
//            $id = Item::where('id', $item->id)->first();
//        } while ($id != null);
//        $item->is_available = $request->is_available === 'on' ? true : false;
//        $item->sort_number = $max_sort_number + 1;
//        $item->save();
//
//
//        return redirect()->route('restaurant.menu', [
//            'restaurant' => $category->section->restaurant,
//            'sections' => $category->section->restaurant->sections,
//            'active-section-id' => $category->section->id,
//        ]);
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
        $item = Item::find($id);
        $item->delete();
        // redirect back
        return redirect()->back();
    }

    public function list($itemIDs){

        // get $itemsIDs from request query

        // $itemIDs = request()->query('itemIDs');

        // get type of $itemIDs

        $itemIDs = json_decode($itemIDs);

        // $itemIDs = explode(',', $itemIDs);
        $items = Item::whereIn('id', $itemIDs)->get();

        return $items;
    }
}
