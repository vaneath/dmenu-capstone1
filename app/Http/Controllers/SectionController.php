<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        // get section but only belongs to the restaurant
        $sections = new Section();
        $tables = $sections->getTable();
        $section_columns = Schema::getColumnListing($tables);
        $section_columns = array_diff($section_columns, ['created_at', 'updated_at']);
        return view('section.index', [
            'sections' => Section::where('user_id', Auth::id())->get(),
            'section_columns' => $section_columns
        ]);
    }

    public function store(Request $request)
    {
        //
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
