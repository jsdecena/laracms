<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title> @yield('meta-title') </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @section('header')

        {{ HTML::style('themes/admin/css/bootstrap.min.css') }}        
        {{ HTML::style('themes/admin/css/font-awesome.min.css') }}
        {{ HTML::style('themes/admin/css/admin.css') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        @show
    </head>
    <body class="bg-black">
        
        @yield('body')

        @section('footer')
        {{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js') }}
        {{ HTML::script('themes/admin/js/bootstrap.min.js') }}
        @show
    </body>
</html>