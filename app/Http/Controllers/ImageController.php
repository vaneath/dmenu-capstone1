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
        return 'hi';
        $file=$request;
        return $file;
    }
}
