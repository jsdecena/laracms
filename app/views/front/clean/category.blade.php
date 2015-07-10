@extends('front.marketing.tpl.main')

@section('meta-title')
{{ ucwords(Request::segment(1)) }}
@stop

@section('body')
	<div class="col-md-8 wrap">
		<h1>{{ $category->category }}</h1> <hr>
	    @if(isset($posts) && !empty($posts) && ! $posts->isEmpty())
		    @foreach( $posts as $post )
			    <article class="row">
			        <div class="span3 pull-left">
			        	<a href="{{ URL::to($post->slug) }}">
				            @if( isset($post->img_src))			            	
				            	<img src="{{ asset("uploads/$post->img_src") }}" alt="{{ $post->title }}" width="250" height="150" class="img-responsive">			            	
				            @else
								<img src="http://placehold.it/250x150" alt="no-featured-image" class="img-responsive">
				            @endif
			            </a>
			        </div>
			        <div class="span4 pull-right">
			            <h3><a href="{{ URL::to($post->slug) }}">{{ $post->title }}</a></h3>
			            <p><span class="fa fa-calendar"></span> Posted on {{ date('F d Y', strtotime($post->created_at)) }}</p>
			            <div class="content">{{ str_limit($post->content, 250, ' ...') }}</div>
			            <a class="btn btn-primary read-more" href="{{ URL::to($post->slug) }}">Read More <span class="fa fa-chevron-right"></span></a>
			        </div>
			    </article>
		    @endforeach
		    {{ $posts->links() }}
		@else
			<p class="alert alert-danger">Sorry, not posts to show.</p>
		@endif
	</div>
	<aside class="col-md-4">
		<div class="sidebar archives">
			<h2>Search</h2>
			{{ Form::open(array('url' => 'search', 'role'=>'form', 'class' => 'form-horizontal', 'method' => 'get')) }}
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" name="term" value="" placeholder="Search now">
					<div class="input-group-addon"><i id="btn_search" class="glyphicon glyphicon-search"></i></div>
				</div>
			</div>					
			{{ Form::close() }}
		</div>				
		<div class="sidebar archives">
			<h2>Archives</h2>
			<ul>
				<li><a href="#">January</a></li>
				<li><a href="#">February</a></li>
				<li><a href="#">March</a></li>
			</ul>
		</div>
	</aside>		
@stop