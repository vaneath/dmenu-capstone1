<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Section;
use App\Models\Restaurant;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $request->is_visible = $request->is_visible === 'on' ? true : false;
        $restaurant = Restaurant::find($request->restaurant_id);
        $maxSortNumber = $restaurant->sections->max('sort_number');
        $section = new Section();
        $section->name = $request->name;
        $section->is_visible = $request->is_visible;
        $section->sort_number = $maxSortNumber + 1;
        $section->restaurant_id = $request->restaurant_id;
        $section->save();

        return redirect()->route('category.index', [
            'restaurant' => $restaurant,
            'sections' => $restaurant->sections,
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
