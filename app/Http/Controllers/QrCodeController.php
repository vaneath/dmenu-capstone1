<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Category;
use App\Models\Item;

class QrCodeController extends Controller
{
    public function index($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        $sections = $restaurant->sections;
        if ($restaurant == null) {
            abort(404);
        }
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('admin.category.index', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('admin.category.index', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else{
            if ($sections->isEmpty()) {
                return view('admin.category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                // find sections with visible
                // $sections = $sections->where('is_visible', 1)->first()->id;
                // dd($sections);
                return view('admin.category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    // find sections first visible
                    'activeSectionPage' => $sections->where('is_visible', 1)->first()->id,
                    // 'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
    }
}
