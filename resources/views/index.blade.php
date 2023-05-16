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
    <div class="home-image">
    <img src="{{ asset('images/Home.png') }}" alt="">
    </div>
    <div><video style="width:100%;" muted autoplay loop>
    <source src="{{ asset('video/video1.mp4') }}" type="video/mp4" />
</video>
</div>
<div class="table">
  <div id="a1">A1</div>
  <div id="b1">B1</div>
  <div id="a2">A2</div>
  <div id="a3">A3</div>
  <div id="b3">B3</div>
</div>
</body>
</html>
</x-app-layout>
