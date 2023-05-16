<x-app-layout>
<!doctype html>
<html>
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
    <img src="{{ asset('images/background1.png') }}" alt="">
    </div>
    <div>
        <h1>With Dmenu, you can enjoy the modern way of ordering food in a restaurant. Just scan the QR Code and your food will be at your table in no time. </h1>
       
    </div>
    <div><video style="width:100%;" muted autoplay loop>
    <source src="{{ asset('video/video1.mp4') }}" type="video/mp4" />
</video>
</div>
</body>
</html>
</x-app-layout>
