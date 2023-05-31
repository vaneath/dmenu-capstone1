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
        
        $file = file_get_contents($filePath);

        // get the type of $file
        $finfo = finfo_open();
        $mime_type = finfo_buffer($finfo, $file, FILEINFO_MIME_TYPE);
        finfo_close($finfo);

        // Storage::disk('do-spaces')->put('uploads', $file, 'public');

        return $mime_type;
    }
}
