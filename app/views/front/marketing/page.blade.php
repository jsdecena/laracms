@extends('front.marketing.tpl.main')

@section('body')
	<section class="wrap" id="page">
		<article class="col-md-8">
			 @if( isset($record) && $record )
				<h2>{{ $record->title }}</h2>
				<div class="content">
					{{ $record->content }}
				</div>
			@else
				<p class="alert alert-danger">Sorry, we cannot find the page you are looking. Please try again.</p>
			@endif				
		</article>
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
	</section>
@stop