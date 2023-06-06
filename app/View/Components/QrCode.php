<?php

namespace App\View\Components;

use App\Models\Restaurant;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QrCode extends Component
{
	public function render(): View
	{
//        $restaurant = Restaurant::find(1);
//        $url = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=';
//
//		if ($restaurant) {
//            return view('components.qr-code', [
//                'url' => $url,
//                'restaurant' => $restaurant->name,
//                'qr_code_url' => $restaurant->qr_code_url,
//            ]);
//        }
//        return view('components.qr-code', [
//            'url' => $url,
//            'restaurant' => 'No restaurant found',
//            'qr_code_url' => $restaurant->qr_code_url,
//        ]);
        return view('components.qr-code');
	}
}
