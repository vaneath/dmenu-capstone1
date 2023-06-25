<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list reviews
        $user_id = request()->query('user_id');
        $reviews = Review::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        $reviews->load('restaurant');
        $reviews->load('order');

        return response()->json([
            'user_id' => $user_id,
            'reviews' => $reviews,
            'restaurants' => Restaurant::where('user_id', $user_id)->get(),
        ]);
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
    public function show(string $id)
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
