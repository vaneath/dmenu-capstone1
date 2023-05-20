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
        do {
            $section->unique_id = uniqid('ds', true);
            $unique_id = Section::where('unique_id', $section->unique_id)->first();
        } while ($unique_id != null);
        $section->restaurant_id = $request->restaurant_id;
        $section->save();

        return redirect()->route('restaurant.menu', [
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
