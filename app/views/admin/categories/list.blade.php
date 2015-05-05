{{-- CATEGORIES LIST BLADE --}}

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
	    
	    @if( isset($categories) && !$categories->isEmpty() )
			<table class="table table-striped">
				<thead>
					<th>ID</th>
					<th>Title</th>
					<th>Content</th>
					<th>Status</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<td>{{ $category->id_category }}</td>
						<td>{{ str_limit($category->category, 20, ' ...') }}</td>
						<td>{{ str_limit($category->description, 150, ' ...') }}</td>
						<td id="status">
							
							
							@if($category->id_category != 1)
								@if( $category->status == 1 )
									<a href="{{ URL::to("admin/categories/disable/$category->id_category") }}" class="btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="fa fa-check"></i></a>
								@else
									<a href="{{ URL::to("admin/categories/enable/$category->id_category") }}" class="btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="fa fa-times"></i></a>
								@endif
							@endif
						
						</td>
						<td id="delete">
							@if($category->id_category != 1)
								<a target="_blank" href="{{ URL::to("categories/$category->id_category") }}" class="btn btn-default"><i class="fa fa-eye"></i> View</a>
								<a href="{{ URL::to("admin/categories/edit/$category->id_category") }}" class="btn btn-primary {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
								<a href="{{ URL::to("admin/categories/delete/$category->id_category") }}" class="btn btn-danger {{ $logged->can('Delete') ? '' : 'disabled' }}"><i class="glyphicon glyphicon-trash"></i> Delete</a>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $categories->links() }}
		@else
			<p class="alert alert-danger">Sorry, not category to show.</p>
		@endif
	</div>
@stop