@extends('front.'.$theme.'.tpl.main')

@section('body')
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{URL::to('themes/front/clean/img/about-bg.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>{{$page->title}}</h1>
                        <hr class="small">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">{{$page->content}}</div>
        </div>
    </div>
@stop