@props(['restaurantUrl'])

<div>
    <div class="bg-blue max-w-[40rem]">
        <img
            {{--        src="{{ $url . $restaurantUrl }}"--}}
            src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=test"
            alt=""
        >
    </div>
</div>
