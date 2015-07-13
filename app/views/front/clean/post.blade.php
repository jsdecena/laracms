@extends('front.'.$theme.'.tpl.main')

@section('body')
    
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background: @if(isset($post->img_src)) url('{{URL::to('uploads/'.$post->img_src.' ')}}') @else #333 @endif" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>{{$post->title}}</h1>
                        <hr class="small">
                        <p class="post-meta">
                            Posted by <a href="#">{{$author->firstname}}</a> on {{date('M d Y', strtotime($post->created_at))}} 
                            <?php $categories = Posts::find($post->id_post)->categories; ?>
                            @if(!$categories->isEmpty())
                                in 
                                @foreach($categories as $category) 
                                    <a href="{{URL::route('cat.show', $category->slug)}}"> <em>{{$category->name}}</em></a> 
                                @endforeach
                            @endif
                        </p>
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