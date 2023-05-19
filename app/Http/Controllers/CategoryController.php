<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // restaurants/{restaurant}/sections/{section}/categories in index function
    public function index(Restaurant $restaurant, Section $section)
    {
//        if ($section->restaurant_id != $restaurant->id) {
//            abort(403);
//        }
//        $categories = Category::where('section_id', $section->id)->get();
//        return view('category.index-categories', [
//            'restaurant' => $restaurant,
//
//            'categories' => $section->categories,
//        ]);
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('category.index', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
                'categories' => $sections->get(0)->categories
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('category.index', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
                'categories' => $sections->get(0)->categories
            ]);
        } else {
            if ($sections->isEmpty()) {
                return view('category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                    'categories' => $sections->get(0)->categories
                ]);
            } else {
                return view('category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => $sections->first()->id,
                    'categories' => $sections->get(0)->categories
                ]);
            }
        }

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
        $category->save();
        return redirect()->route('category.index', [
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
