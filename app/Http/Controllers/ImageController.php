<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(){
        // dd('');
        return 'bye';
    }

    public function store(Request $request){
        // dd('hi');
        // return 'hi';
        // Storage::disk('do-spaces')->putFile('uploads', $request->file('logo'), 'public');
        $filePath = $request->logo;
        // get file from file path
        $file = file_get_contents($filePath);

        Storage::disk('do-spaces')->put('uploads', $file, 'public');

        return $filePath;
    }
}
