
<div class="masthead">
<h3 class="text-muted">
	<a href="{{ URL::to('/') }}">
		<img src="{{ asset('themes/front/marketing/img/logo.png') }}" alt="xfinity cms" width="200" height="80" class="img-responsive" />
	</a>
</h3>
<ul class="nav nav-justified">
  <li class="active"><a href="{{ URL::to('/') }}">Home</a></li>
      @if(isset($pages))
      	@foreach( $pages as $page )
      		<li><a href="{{ URL::to($page->slug) }}">{{ $page->title }}</a></li>
      	@endforeach
      @endif
      <li><a href="{{ URL::to('contact') }}">Contact</a></li>
</ul>
</div>
