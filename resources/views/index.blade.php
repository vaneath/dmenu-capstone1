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
    <div class="example">
        With Dmenu, you can enjoy the modern way of ordering food in a restaurant. Just scan the QR Code and your food will be at your table in no time.</div>
<div>
  <video style="width:100%;" muted autoplay loop>
    <source src="{{ asset('video/video2.mp4') }}" type="video/mp4" />
</video>
</div>
<div class="example1">
        Meet Our Amazing Team</div>
<div style="width:100%;">
    <img style="padding: 0; object-fit: cover; height: 100%; width:100%; "src="{{ asset('images/team.png') }}" alt="">
    </div>
</body>
</html>
</x-app-layout>
