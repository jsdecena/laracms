@extends('front.'.$theme.'.tpl.main')

@section('body')
    
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{URL::to('themes/front/clean/img/post-bg.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>{{$post->title}}</h1>
                        <hr class="small">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    {{$post->content}}
                </div>
            </div>
        </div>
    </article>

    <hr>
@stop