@extends('front.marketing.tpl.main')

@section('meta-title') LaraCMS - Open source cms project made in the Philippines @stop

@section('meta-description') Open source CMS project made in the Philippines @stop

@section('meta-tags') open source, cms, philippines @stop

@section('body')
<div class="container">
	<!-- Jumbotron -->
	<div class="jumbotron">
	<h1>Marketing stuff!</h1>
	<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>
	<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>
	</div>

	@if(isset($records))
		<div class="row">
			@foreach($records as $record)
				<div class="col-lg-4">
					<h2>{{ $record->title }}</h2>
					{{ str_limit($record->content, 100, ' ...') }}
					<p><a class="btn btn-primary" href="{{ URL::to($record->slug) }}" role="button">View details &raquo;</a></p>
				</div>
			@endforeach
		</div>
	@endif
</div>
@stop