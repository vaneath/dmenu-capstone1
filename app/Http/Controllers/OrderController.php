<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Section;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('restaurant.show-my-order', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('restaurant.show-my-order', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else {
            if ($sections->isEmpty()) {
                return view('restaurant.show-my-order', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                return view('restaurant.show-my-order', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $sections = Section::where('restaurant_id', $restaurant->id)->get();
        $sections = $sections->sortBy('sort_number');
        $activeSectionPage = request()->query('active-section-id');
        if ($activeSectionPage != null && $sections->contains('id', $activeSectionPage)) {
            return view('restaurant.checkout', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $activeSectionPage,
            ]);
        } elseif ($activeSectionPage != null && !$sections->contains('id', $activeSectionPage)) {
            return view('restaurant.checkout', [
                'restaurant' => $restaurant,
                'sections' => $sections,
                'activeSectionPage' => $sections->first()->id,
            ]);
        } else {
            if ($sections->isEmpty()) {
                return view('restaurant.checkout', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => null,
                ]);
            } else {
                return view('restaurant.checkout', [
                    'restaurant' => $restaurant,
                    'sections' => $sections,
                    'activeSectionPage' => $sections->first()->id,
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
