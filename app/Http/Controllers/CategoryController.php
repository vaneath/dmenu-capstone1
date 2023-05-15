<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // restaurants/{restaurant}/sections/{section}/categories in index function
    public function index(Restaurant $restaurant, Section $section)
    {
        if ($section->restaurant_id != $restaurant->id) {
            abort(403);
        }
        $categories = Category::where('section_id', $section->id)->get();
        return view('restaurant.show-categories', [
            'restaurant' => $restaurant,
            'section' => $section,
            'categories' => $section->categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->is_visible = $request->is_visible === 'on' ? true : false;
        $section = Section::find($request->section_id);
        $maxSortNumber = $section->categories->max('sort_number');
        $category = new Category();
        $category->name = $request->name;
        $category->img_url = $request->img_url;
        $category->is_visible = $request->is_visible;
        $category->sort_number = $maxSortNumber + 1;
        $category->section_id = $request->section_id;
        $category->save();
        return redirect()->route('restaurant.show', [
            'restaurant' => $section->restaurant,
            'sections' => $section->restaurant->sections,
            'active-section-id' => $section->id,
        ]);
    }

    public function show($id)
    {
        return view('components.menu-card');
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
