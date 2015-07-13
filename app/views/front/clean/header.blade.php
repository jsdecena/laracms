@section('meta-title') Clean Blog - Theme by Start Bootstrap @stop

@section('meta-description') Open source CMS project made in the Philippines @stop

@section('meta-tags') open source, cms, philippines @stop

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
            <a class="navbar-brand" href="{{URL::route('home')}}">Clean Blog</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="primary_nav_wrap" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right cleanmenu">
                <li><a href="{{URL::route('home')}}">Home</a></li>
                @foreach($pages as $page)
                    <li><a href="{{URL::route('page.show', $page->slug)}}">{{$page->title}}</a></li>
                @endforeach
                @if(!$categories->isEmpty())
                    <li>                 
                        <a href="javascript: void(0)">Categories <i class="fa fa-chevron-down"></i></a>
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li><a href="{{URL::route('cat.show', $category->slug)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>