<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
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
        $attributes = request()->validate([
            'name' => 'required',
            'bg_img_url' => 'required|image',
            'is_available' => 'required|boolean',
            'restaurant_id' => 'required',
            'tag_id' => 'required',
        ]);

        $attributes['id'] = Str::random(10);
        $attributes['bg_img_url'] = request('bg_img_url')->store('categories/' . Restaurant::where('id', $attributes['restaurant_id'])->value('name'));

        Category::create($attributes);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant, Category $category)
    {
//        dd(auth()->user()?->id === $restaurant->user_id);
        return Inertia::render('Category/Index', [
            'canCreate' => auth()->user()?->id === $restaurant->user_id,
            'restaurant' => $restaurant,
            'tags' => $restaurant->tags,
            'categories' => $restaurant->categories,
            'currentTag' => $category->tag_id,
            'currentCategory' => $category->id,
            'items' => $category->items,
            'showItem' => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // 
        $category->update([
            'is_available' => request('is_available'),
            'name' => request('name'),
            'tag_id' => request('tag_id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category)
    {
        // 
        $category->update([
            'is_available' => request('is_available'),
            'name' => request('name'),
            'tag_id' => request('tag_id'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant, Category $category)
    {
        // delete a category
        $category->delete();
    }
}
