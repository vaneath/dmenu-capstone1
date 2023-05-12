<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        return view('category.index', [
            'restaurant' => $restaurant,
        ]);
    }

    public function store(Request $request)
    {
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
