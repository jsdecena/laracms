<ul class="list-unstyled">
	@if(Session::get('success'))
	    <li class="alert alert-success">{{ Session::get('success') }} <button type="button" class="close" data-dismiss="alert">&times;</button></li>
	@elseif(Session::get('error'))
		<li class="alert alert-success">{{ Session::get('error') }} <button type="button" class="close" data-dismiss="alert">&times;</button></li>
	@else
	    @if($errors->all())
	        <ul class="list-unstyled">
	            @foreach($errors->all() as $error)
	                <li class="alert alert-danger"><button type="button" class="close pull-right" data-dismiss="alert">&times;</button>{{ $error }}</li>
	            @endforeach
	        </ul>
        @endif
	@endif
</ul>