<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Category;
use App\Models\Item;

class QrCodeController extends Controller
{
    public function index($unique_id)
    {
        $restaurant = Restaurant::where('unique_id', $unique_id)->first();
        if ($restaurant == null) {
            abort(404);
        }
        return redirect()->route('restaurant.menu', [
            'restaurant' => $restaurant,
            'sections' => $restaurant->sections,
        ]);
    }
}
