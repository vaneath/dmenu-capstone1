<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(){
        $content = Storage::disk('do-spaces')->get('khmergpt-img-14-10-24.jpg');
        
        dd($content);

        return $content;
        // dd('');

        // $disk = Storage::disk('do-spaces');
        // dd(Storage::disk('do-spaces')->exists('images/khmergpt-img-14-10-24.jpg'));

        // $content = Storage::disk('do-spaces')->get('khmergpt-img-14-10-24.jpg');

        // $listContents = Storage::disk('do-spaces')->listContents('images');

        // dd($content, $listContents);

        return 'bye';
    }

    public function store(Request $request){
        // dd('hi');
        // return 'hi';
        // Storage::disk('do-spaces')->putFile('uploads', $request->file('logo'), 'public');

        $content = Storage::disk('do-spaces')->get('khmergpt-img-14-10-24.jpg');
        return $content;

        $filePath = $request->logo;
        
        $file = file_get_contents($filePath);

        // get the type of $file
        $finfo = finfo_open();
        $mime_type = finfo_buffer($finfo, $file, FILEINFO_MIME_TYPE);
        finfo_close($finfo);

        Storage::disk('do-spaces')->put('example.txt', 'Contents');
        $contents = Storage::disk('do-spaces')->get('example.txt');


        Storage::disk('do-spaces')->put('uploads', $file, 'public');

        return $contents;
    }
}
