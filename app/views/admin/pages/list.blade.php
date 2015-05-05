{{-- PAGES LIST BLADE --}}

@extends('admin.tpl.main')

@section('body')	
	<div id="content-body">
	    @if(Session::get('success'))
	        <p class="alert alert-success">
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	            {{ Session::get('success') }}
	        </p>
	    @elseif(Session::get('error'))
	        <p class="alert alert-danger">
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	            {{ Session::get('error') }}
	        </p>
	    @endif
	    
	    @if( isset($pages) && !$pages->isEmpty() )	    	
			<table class="table table-striped">
				<thead>
					<th class="col-md-1">ID</th>
					<th class="col-md-2">Title</th>
					<th class="hidden-xs col-md-4">Content</th>
					<th class="col-md-1">Status</th>
					<th class="col-md-2">Actions</th>
				</thead>
				<tbody>
					@foreach($pages as $page)
					<tr>
						<td>{{ $page->id_post }}</td>
						<td>{{ str_limit($page->title, 20, ' ...') }}</td>
						<td class="hidden-xs">{{ str_limit($page->content, 100, ' ...') }}</td>
						<td id="status">
							@if( $page->status == 1 )
								<a href="{{ URL::to("admin/pages/disable/$page->id_post") }}" class="btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }} "><i class="fa fa-check"></i></a>
							@else
								<a href="{{ URL::to("admin/pages/enable/$page->id_post") }}" class="btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }} "><i class="fa fa-times"></i></a>
							@endif
						</td>
						<td id="delete">
							<a href="{{ URL::to("admin/pages/edit/$page->id_post") }}" class="btn btn-primary {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{ URL::to("admin/pages/delete/$page->id_post") }}" class="btn btn-danger {{ $logged->can('Delete') ? '' : 'disabled' }} "><i class="glyphicon glyphicon-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $pages->links() }}
		@else
			<p class="alert alert-danger">Sorry, not page to show.</p>
		@endif
	</div>
@stop