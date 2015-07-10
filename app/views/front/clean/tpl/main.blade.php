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
    <link rel="shortcut icon" href="{{$shortcut}}" type="image/x-icon">
    <link rel="icon" href="{{$favicon}}" type="image/x-icon">

    <title>Clean Blog - Theme by Start Bootstrap</title>
   
   {{ HTML::style('themes/front/'.$theme.'/css/bootstrap.min.css') }}
   {{ HTML::style('themes/front/'.$theme.'/css/clean-blog.css') }}
   {{ HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}
   {{ HTML::style('https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic') }}
   {{ HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') }}   

   {{ HTML::script('themes/front/'.$theme.'/js/jquery.min.js') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
  </head>

  <body>
    
    @include('front.'.$theme.'.header')

    @yield('body')

    @include('front.'.$theme.'.footer')

    {{ HTML::script('themes/front/'.$theme.'/js/bootstrap.min.js') }}
    {{ HTML::script('themes/front/'.$theme.'/js/clean-blog.js') }}  
  </body>
</html>