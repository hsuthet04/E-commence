<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="Shortcut icon" href="{{asset("images/PetCafelogo.jpg")}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/custom.css")}}">
</head>

<body>

    @include('layout.nav')
    <!-- <div class="d-flex">
        <img src="{{asset("images/home2.jpg")}}" alt="" style="width: 100%;">
        <img src="{{asset("images/home3.jpg")}}" alt="" style="width: 100%;">
    </div> -->
    @yield('content')
    <script src="{{asset("js/app.js")}}"></script>
    <script src="{{asset("js/custom.js")}}"></script>
    <script src="https://kit.fontawesome.com/47655717bb.js" crossorigin="anonymous"></script>
    @yield("script")
</body>

</html>