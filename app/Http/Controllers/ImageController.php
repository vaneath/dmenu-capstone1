<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(){
        // dd('');

        // $disk = Storage::disk('do-spaces');
        // dd(Storage::disk('do-spaces')->exists('images/khmergpt-img-14-10-24.jpg'));

        // $content = Storage::disk('do-spaces')->get('khmergpt-img-14-10-24.jpg');

        // $listContents = Storage::disk('do-spaces')->listContents('images');

        // dd($content, $listContents);

        $client_id = "c24e5980b0c2515";
        $image_path = "public\images\dmenu.png";
        $image = file_get_contents($image_path);
        // dd($image_path, file_exists($image_path));
        $title = "My Image";
        $description = "This is my image.";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'Authorization' => 'Client-ID ' . $client_id,
            'Content-Type' => 'multipart/form-data',
            'image' => base64_encode($image),
            'title' => $title,
            'description' => $description,
        ]);

        $response = curl_exec($ch);

        dd($response);

        $data = json_decode($response, true);
        
        dd($data);

        curl_close($ch);

        return 'bye';
    }

    public function store(Request $request){
        // dd('hi');
        // return 'hi';
        // Storage::disk('do-spaces')->putFile('uploads', $request->file('logo'), 'public');
        $filePath = $request->logo;

        $client_id = "c24e5980b0c2515";
        $image = file_get_contents($file_path);
        // dd($image_path, file_exists($image_path));
        $title = "My Image";
        $description = "This is my image.";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'Authorization' => 'Client-ID ' . $client_id,
            'Content-Type' => 'multipart/form-data',
            'image' => base64_encode($image),
            'title' => $title,
            'description' => $description,
        ]);

        $response = curl_exec($ch);

        dd($response);
        
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
