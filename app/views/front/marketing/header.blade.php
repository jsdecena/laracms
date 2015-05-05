<div class="masthead">
<h1 class="text-muted">
	<a href="{{ URL::to('/') }}">LaraCMS</a>
</h1>
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