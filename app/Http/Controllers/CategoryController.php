<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Restaurant $restaurant, Section $section)
    {
        if ($section->restaurant_id != $restaurant->unique_id) {
            abort(403);
        }
        // $categories = Category::where('section_id', $section->id)->get();
        return view('admin.restaurant.show-categories', [
            'restaurant' => $restaurant,
            'section' => $section,
            'categories' => $section->categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->is_visible = $request->is_visible === 'on';
        $section = Section::find($request->section_id);
        $maxSortNumber = $section->categories->max('sort_number');
        $category = new Category();
        $category->name = $request->name;
        $category->img_url = $request->img_url;
        $category->is_visible = $request->is_visible;
        $category->sort_number = $maxSortNumber + 1;
        $category->section_id = $request->section_id;
        do {
            $category->unique_id = uniqid('dc', true);
            $unique_id = Category::where('unique_id', $category->unique_id)->first();
        } while ($unique_id != null);
        $category->save();
        return redirect()->route('restaurant.menu', [
            'restaurant' => $section->restaurant,
            'sections' => $section->restaurant->sections,
            'active-section-id' => $section->id,
        ]);
    }

    public function show(Restaurant $restaurant, $category)
    {
        $category = Category::where('id', $category)->first();
        // $items = $category->items;
        // return view('components.menu-card', [
        //     'url' => 'test.com',
        //     'name' => 'test',
        //     'description' => 'test',
        //     'price' => 'test',
        // ]);
        return view('admin.category.show', [
            'restaurant' => $restaurant,
            'sections' => $restaurant->sections,
            'category' => $category,
            'items' => $category->items,
            'activeSectionPage' => $category->section->id,
        ]);
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
