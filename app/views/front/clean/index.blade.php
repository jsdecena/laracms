<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="name" content=" Clean Blog - Theme by Start Bootstrap ">
    <meta name="description" content="Open source CMS project made in the Philippines ">
    <meta name="tags" content="open source, cms, philippines ">
    <meta name="author" content="Jeff Simons Decena">
    <link rel="shortcut icon" href="http://localhost:8000/themes/front/clean/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="http://localhost:8000/themes/front/clean/img/favicon.ico" type="image/x-icon">

    <title>Clean Blog - Theme by Start Bootstrap</title>
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />

   <link media="all" type="text/css" rel="stylesheet" href="http://localhost:8000/angular/assets/css/style.css">

   <link media="all" type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

   <link media="all" type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">

   <link media="all" type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
   
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-sanitize.js"></script>

   <script type="text/javascript" src="http://localhost:8000/angular/app.js"></script>

  </head>

  <body ng-app="laracms">
    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary_nav_wrap">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://localhost:8000">Clean Blog</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="primary_nav_wrap" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right cleanmenu">
                    <li><a href="http://localhost:8000">Home</a></li>
                    <li><a href="http://localhost:8000/page/blog">Blog</a></li>
                    <li><a href="javascript: void(0)">Categories <i class="fa fa-chevron-down"></i></a>
                        <ul class="list-unstyled"></ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
        <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('http://localhost:8000/themes/front/clean/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <hr class="small">
                        <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" ng-controller="GetPostsController">

                <div class="post-preview" ng-repeat="post in postsList">
                    <h2 class="post-title"><a href="http://localhost:8000/post/lorem-ipsum-dolor-sit-amet"> <% post.title %></a></h2>
                    <p class="post-meta">Posted by <a href="#"><% post.firstname %></a> on <% post.created_at | date : "longDate" %></p>
                    <div class="post-content" ng-bind-html="getHtml(post.content)"></div>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Your Website 2015</p>
                </div>
            </div>
        </div>
    </footer>
  </body>
</html>