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
    <link rel="shortcut icon" href="{{ asset('themes/front/img/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('themes/front/img/favicon.ico')}}" type="image/x-icon">

    <title>Xfinity CMS - Theme by Twitter Bootstrap Justified Nav</title>
   
   @section('header')
       {{ HTML::style('themes/front/marketing/css/bootstrap.min.css') }}
       {{ HTML::style('themes/front/marketing/css/style.css') }}
   @show
  </head>

  <body>
    <div class="container">
      @include('front.marketing.header')

      @yield('body')
      
      @include('front.marketing.footer')

    </div> <!-- /container -->

    {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js') }}
    {{ HTML::script('themes/front/marketing/js/bootstrap.min.js') }}
    {{ HTML::script('themes/front/marketing/js/front.js') }}
    {{ HTML::script('themes/front/marketing/js/ie10-viewport-bug-workaround.js') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->   
  </body>
</html>