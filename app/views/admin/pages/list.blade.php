{{-- PAGES LIST BLADE --}}

@extends('admin.tpl.main')

@section('body')	
	<div id="content-body">
	    @include('messages')
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
								<a onClick="return confirm('Are you sure you want to disable?')" href="{{ URL::route("pages.disable", "id=" . $page->id_post) }}" class="btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }} "><i class="fa fa-check"></i></a>
							@else
								<a onClick="return confirm('Are you sure you want to enable?')" href="{{ URL::route("pages.enable", "id=" . $page->id_post) }}" class="btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }} "><i class="fa fa-times"></i></a>
							@endif
						</td>
						<td>
							@if($logged->can('Delete'))
								{{Form::open(array('url' => URL::route('pages.destroy', $page->id_post), 'method' => 'delete'))}}
									@if($logged->can('Edit'))<a href="{{ URL::route("pages.edit", $page->id_post) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>@endif
									<button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
								{{Form::close()}}
							@endif
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