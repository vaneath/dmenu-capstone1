<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

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
                if(!Auth::check() || (Auth::check() && Auth::user()->id != $restaurant->user_id)){
                    $activeSectionPage = $sections->where('is_visible', 1)->first()->id;
                } else{
                    $activeSectionPage = $sections->first()->id;
                }
                return view('admin.category.index', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    // find sections first visible
                    'activeSectionPage' => $activeSectionPage,
                    // 'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
    }
}
