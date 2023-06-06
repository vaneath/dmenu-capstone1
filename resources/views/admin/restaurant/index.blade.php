@extends('layouts.master')

@section('body')
    <div class="grid grid-cols-2 sm:grid-cols-3 justify-items-center lg:grid-cols-5 gap-3"
               x-data="
{
    openQrCode: false,
    qrCodeRestaurant: '',
    qrCodeUrl: null,
    handleOpenQrCode: function(event){
        this.openQrCode = true;
        this.qrCodeRestaurant = event.detail.qrCodeRestaurant;
        this.qrCodeUrl = event.detail.qrCodeUrl;
    },
    closeQrCode: function(){
        this.openQrCode = false;
    }
}"

               x-on:close-qr-code.window="closeQrCode()"
               x-on:open-qr-code.window="handleOpenQrCode($event)"
    >
        <x-restaurant.restaurant-create />
        @foreach($restaurants as $restaurant)
            <x-restaurant.restaurant-card :restaurant="$restaurant" />
        @endforeach

        <x-qr-code :restaurant="$restaurant" />
    </div>

@endsection
