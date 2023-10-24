<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="Shortcut icon" href="{{asset("images/PetCafelogo.jpg")}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    
</head>

<body style="background-color: #BCB88A;">

    @include('layout.nav')
    <div class="d-flex">
        <img src="{{asset("images/home2.jpg")}}" alt="" style="width: 100%;">
        <img src="{{asset("images/home3.jpg")}}" alt="" style="width: 100%;">
    </div>
    @yield('content')

</body>
<script src="https://kit.fontawesome.com/47655717bb.js" crossorigin="anonymous"></script>
</html>