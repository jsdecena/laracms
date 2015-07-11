@extends('front.'.$theme.'.tpl.main')

@section('body')
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{URL::to('themes/front/clean/img/post-bg.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>{{$category->name}}</h1>
                        <hr class="small">
                    </div>
                </div>
            </div>
        </div>
    </header>

	@if(!$records->isEmpty())
		@foreach($records as $record)
		    <!-- Post Content -->
		    <article>
		        <div class="container">
		            <div class="row">
		                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
		                    <h1><a href="{{URL::route('post.show', $record['post']->slug)}}">{{$record['post']->title}}</a></h1>
		                    <p class="post-meta">Posted by <a href="#">{{$record['author']->firstname}}</a> on {{date('M d Y', strtotime($record['post']->created_at))}}</p>
		                    {{$record['post']->content}}
		                </div>
		            </div>
		        </div>
		    </article>
		    <hr>
	    @endforeach
	    <article><div class="container"><div class="row"><div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">{{$records->links()}}</div></div></div></article>
	@else
		<p class="alert alert-warning">No post to show.</p>
	@endif
@stop