{{-- CATEGORIES LIST BLADE --}}

@extends('admin.tpl.main')

@section('body')
	
	<div id="content-body">
		
		@include('messages')
	    
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
						@if($logged->can('Edit'))
						<td>
							@if($category->id_category != 1)
								@if( $category->status == 1 )
									<a onClick="return confirm('Are you sure you want to disable?')" href="{{ URL::route("category.disable", "id=$category->id_category") }}" class="btn btn-success"><i class="fa fa-check"></i></a>
								@else
									<a onClick="return confirm('Are you sure you want to enable?')" href="{{ URL::route("category.enable", "id=$category->id_category") }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
								@endif
							@endif
						
						</td>
						@endif
						<td>
							@if($category->id_category != 1)
								{{Form::open(array('url' => URL::route('categories.destroy', $category->id_category), 'method' => 'delete'))}}
									@if($logged->can('Edit'))<a href="{{ URL::route("categories.edit", $category->id_category) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</a>@endif
									@if($logged->can('Delete'))
										<button onClick="return confirm('Are you sure you want to delete the category?')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
									@endif
								{{Form::close()}}
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