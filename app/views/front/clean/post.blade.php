@extends('front.'.$theme.'.tpl.main')

@section('body')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h2>{{$post->title}}</h2>
                    {{$post->content}}
                </div>
            </div>
        </div>
    </article>

    <hr>
@stop