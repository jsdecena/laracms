@extends('front.'.$theme.'.tpl.main')

@section('body')
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{URL::to('themes/front/clean/img/home-bg.jpg')}}')">
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
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @foreach($records as $record)
                    <div class="post-preview">
                        <a href="{{URL::route('post.show', $record['post']->slug)}}"><h2 class="post-title">{{$record['post']->title}}</h2></a>
                        <p class="post-meta">Posted by <a href="#">{{$record['author']->firstname}}</a> on {{date('M d Y', strtotime($record['post']->created_at))}}</p>
                        <div class="post-content">{{Str::limit($record['post']->content, 280, ' ...')}}</div>
                    </div>
                    <hr>
                @endforeach
                <!-- Pager -->
                {{$records->links()}}
            </div>
        </div>
    </div>

    <hr>
@stop