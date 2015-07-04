<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="name" content="@yield('meta-title')">
    <meta name="description" content="@yield('meta-description')">
    <meta name="tags" content="@yield('meta-tags')">
    <meta name="author" content="Jeff Simons Decena">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('themes/front/marketing/img/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('themes/front/marketing/img/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('themes/front/marketing/img/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('themes/front/marketing/img/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('themes/front/marketing/img/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('themes/front/marketing/img/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('themes/front/marketing/img/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('themes/front/marketing/img/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('themes/front/marketing/img/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ URL::asset('themes/front/marketing/img/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('themes/front/marketing/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('themes/front/marketing/img/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('themes/front/marketing/img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('themes/front/marketing/img/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL::asset('themes/front/marketing/img/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>The Wedding Digest</title>
    
    <script type="text/javascript" src="{{ URL::asset('themes/front/marketing/js/jquery.js') }}"></script>

    @section('header')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ URL::asset('themes/front/marketing/framework/addons/camera/css/camera.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('themes/front/marketing/css/social-icons.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('themes/front/marketing/css/style.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('themes/front/marketing/css/theme-color.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('themes/front/marketing/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('themes/front/marketing/css/firefox.css') }}">
        <script type="text/javascript" src="{{ URL::asset('themes/front/marketing/framework/js/modernizr.js') }}"></script>
    @show
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->     
  </head>

  <body>

        @include('front.marketing.header')
        @yield('body')
        <div class="btn-goto-top border-radius-2px">
            <i class="icon-arrow-up7"></i>
        </div>

        <!-- Body Scripts -->
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/js/jquery-migrate-1.2.1.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/js/jquery.easing.1.3.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/addons/camera/js/camera.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/addons/owl/owl.carousel.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/addons/breaking-news-ticker/jquery.ticker.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/addons/mobile-menu/pushy.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/addons/show-on-scroll/jquery.appear.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/js/holder.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('themes/front/marketing/framework/js/scripts.js')}}"></script>
    </body>
</html>