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
    public function index(Category $category)
    {
        return view('restaurant.show-items', [
            'category' => $category,
            'items' => $category->items,
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
