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
    <div class="textMiddle">
        <h1 style="font-size: 40px; margin: 5em; color: white;">With Dmenu, you can enjoy the modern way of ordering food in a restaurant. Just scan the QR Code and your food will be at your table in no time.</h1>
    </div>
<div><video style="width:100%;" muted autoplay loop>
    <source src="{{ asset('video/video2.mp4') }}" type="video/mp4" />
</video>
</div>

<div class="row">
  <div class="column">
    <img src="wedding.jpg">
    <img src="rocks.jpg">
    <img src="falls2.jpg">
    <img src="paris.jpg">
    <img src="nature.jpg">
    <img src="mist.jpg">
    <img src="paris.jpg">
  </div>
  <div class="column">
    <img src="underwater.jpg">
    <img src="ocean.jpg">
    <img src="wedding.jpg">
    <img src="mountainskies.jpg">
    <img src="rocks.jpg">
    <img src="underwater.jpg">
  </div>
</div>
</body>
</html>
</x-app-layout>
