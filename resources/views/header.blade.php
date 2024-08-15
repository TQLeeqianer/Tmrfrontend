<!DOCTYPE html>
<html>
{{-- <head> --}}

<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
<link rel="stylesheet" href="{{asset('css/fontAwesome.css')}}">
<link rel="stylesheet" href="{{asset('css/hero-slider.css')}}">
<link rel="stylesheet" href="{{asset('css/owl-carousel.css')}}">
<link rel="stylesheet" href="{{asset('css/datepicker.css')}}">
<link rel="stylesheet" href="{{asset('css/templatemo-style.css')}}">

<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

<script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>

<meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Event Organisers | Tivotal</title>

<!--swiper css-->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
/>

<!--font awesome-->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
/>

<!--css file-->
<link rel="stylesheet" href="{{asset('css/fonts/styles.css')}}"/>
<!--
	Venue Template
	http://www.templatemo.com/tm-522-venue
-->

</head>


<body>
<!-- header section starts  -->
<header class="header">
    <a href="#" class="logo"><span>E</span>vent</a>

    <nav class="navbar">
        <a href="{{route('home')}}">home</a>
        <a href="#service">Event</a>
        <a href="#about">about</a>
        <a href="#gallery">gallery</a>
        <a href="#review">review</a>
        <a href="#contact">contact</a>

        <?php $user = Auth::user(); ?>

        @if($user)
            <a href="#">{{$user->name}}</a>
            <a href="{{route('logout')}}">Logout</a>
        @else
            <a href="{{route('login')}}">Login</a>
        @endif

    </nav>

    <div id="menu-bars" class="fas fa-bars"></div>
</header>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
@if(request()->has('success') && request()->query('success') == 'true')
    <script>
        alert('Payment successful');
    </script>
@endif


@if(request()->has('canceled') && request()->query('canceled') == 'true')
    <script>
        alert('Payment canceled');
    </script>
@endif
