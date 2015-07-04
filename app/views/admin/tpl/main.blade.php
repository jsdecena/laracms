<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="{{ asset('themes/admin/img/favicon.ico')}}" type="image/x-icon">
        <link rel="icon" href="{{ asset('themes/admin/img/favicon.ico')}}" type="image/x-icon">        
        @section('header')

        {{ HTML::style('themes/admin/css/bootstrap.min.css') }}

        {{ HTML::style('themes/admin/css/font-awesome.min.css') }}

        {{ HTML::style('themes/admin/css/ionicons.min.css') }}

        {{ HTML::style('themes/admin/css/admin.css') }}

        {{ HTML::style('themes/admin/css/style.css') }}

        {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        @show

    </head>
    <body class="skin-black">
        <header class="header">
            <a href="{{ URL::to('admin') }}" class="logo branding">{{ $website_name }}</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You no new messages</li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning"></span>
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li class="header">You no new notifications</li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>                            
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger"></span>
                            </a>                            
                            <ul class="dropdown-menu">
                                <li class="header">You have no pending tasks</li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                            
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ $name }} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="http://placehold.it/85x85" class="img-circle" alt="User Image" />
                                    <p>
                                        {{ $name }} - Web Developer
                                        <small>Member since {{ $since }}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ URL::route("users.account", "id=" . Auth::id()) }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ URL::to('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            @if(  isset($profile_img) && $profile_img != null )
                                <img src="{{ asset("uploads/$profile_img") }}" class="img-circle 1" alt="User Image" />
                            @else
                                <i class="fa fa-user fa-4x" style="color:#eee;"></i>
                                <!--<img src="http://placehold.it/85x85" class="img-circle" alt="User Image" />-->
                            @endif
                        </div>
                        <div class="pull-left info">
                            <p>Hello, {{{ isset($name) ? $name : null }}}</p>
                            <a class="btn btn-primary" href="{{ URL::to('logout') }}">Logout</a>
                            <a href="{{ URL::route("users.account", "id=" . Auth::id()) }}" class="btn btn-primary">Profile</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li @if(Request::segment(2) == "dashboard")class="active" @endif>
                            <a href="{{ URL::to('admin/dashboard') }}">
                                <i class="fa fa-dashboard fa-fw"></i>
                                <span>Dashboard</span>
                            </a>                        
                        </li>
                        @if(!$logged->can('None'))
                        <li class="treeview @if(Request::segment(1) == "users" || Request::segment(1) == "roles") active @endif">
                            <a href="{{ URL::route('users.index') }}">
                                <i class="fa fa-user fa-fw"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                            <ul class="treeview-menu">
                                @if($logged->can('View'))
                                    <li><a rel="tab" href="{{ URL::route('users.index') }}"><i class="fa fa-angle-double-right"></i> List</a></li>
                                @endif
                               
                                @if($logged->can('Create'))
                                    <li><a href="{{ URL::route('users.create') }}"><i class="fa fa-angle-double-right"></i> Add user</a></li>
                                @endif
                                
                                <li><a href="{{ URL::route('roles.index') }}"><i class="fa fa-angle-double-right"></i>Roles</a></li>
                            </ul>
                           
                        </li>
                        <li class="treeview @if(Request::segment(1) == "pages") active @endif">
                            <a href="{{ URL::route('pages.index') }}">
                                <i class="fa fa-file fa-fw"></i>
                                <span>Pages</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @if($logged->can('View'))
                                    <li><a href="{{ URL::route('pages.index') }}"><i class="fa fa-angle-double-right"></i> List pages</a></li>
                                @endif
                                @if($logged->can('Create'))
                                    <li><a href="{{ URL::route('pages.create') }}"><i class="fa fa-angle-double-right"></i> Add a page</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="treeview @if(Request::segment(1) == "posts") active @endif">
                            <a href="{{ URL::route('posts.index') }}">
                                <i class="fa fa-file-o fa-fw"></i>
                                <span>Posts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @if($logged->can('View'))
                                    <li><a href="{{ URL::route('posts.index') }}"><i class="fa fa-angle-double-right"></i> List posts</a></li>
                                @endif
                                @if($logged->can('Create'))
                                    <li><a href="{{ URL::route('posts.create') }}"><i class="fa fa-angle-double-right"></i> Add a post</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="treeview @if(Request::segment(1) == "categories") active @endif">
                            <a href="{{ URL::route('categories.index') }}">
                                <i class="fa fa-bookmark fa-fw"></i>
                                <span>Categories</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @if($logged->can('View'))
                                    <li><a href="{{ URL::route('categories.index') }}"><i class="fa fa-angle-double-right"></i> List Categories</a></li>
                                @endif
                                @if($logged->can('Create'))
                                    <li><a href="{{ URL::route('categories.create') }}"><i class="fa fa-angle-double-right"></i> Add a Category</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="treeview @if(Request::segment(1) == "carousels") active @endif">
                            <a href="{{ URL::route('carousels.index') }}">
                                <i class="fa fa-rocket fa-fw"></i>
                                <span>Carousels</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @if($logged->can('View'))
                                    <li><a href="{{ URL::route('carousels.index') }}"><i class="fa fa-angle-double-right"></i> Slides </a></li>
                                @endif
                                @if($logged->can('Create'))
                                    <li><a href="{{ URL::route('carousels.create') }}"><i class="fa fa-angle-double-right"></i> Add a slide </a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="treeview @if(Request::segment(1) == "settings" || Request::segment(2) == "backupdb") active @endif">
                            <a href="{{ URL::route('settings.index') }}">
                                <i class="fa fa-wrench fa-fw"></i>
                                <span>Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @if($logged->can('View'))
                                    <li><a href="{{ URL::route('settings.index') }}"><i class="fa fa-angle-double-right"></i> Settings </a></li>
                                @endif
                            </ul>
                        </li>                      
                        @endif
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section id="content-wrap" class="content">
                    <div id="placeholder" class="content">@yield('body')</div>
                </section><!-- /#content wrap -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->        

        @section('footer')

        {{ HTML::script('themes/admin/js/bootstrap.min.js') }}
        {{ HTML::script('themes/admin/js/app.js') }}
        {{ HTML::script('packages/ckeditor/ckeditor.js') }}
        {{ HTML::script('themes/admin/js/admin.js') }}
        {{ HTML::script('themes/admin/js/plugins/iCheck/icheck.min.js') }}
        {{ HTML::script('themes/admin/js/script.js') }}

        @show
    </body>
</html>