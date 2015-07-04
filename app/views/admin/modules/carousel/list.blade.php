{{-- MODULES LIST BLADE --}}

@extends('admin.tpl.main')

@section('body')
	
	<div id="content-body">
	
		<h2>{{ strtoupper(Request::segment(3)) }}</h2>

		@if( isset($carousels) && !$carousels->isEmpty() )
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

			<table class="table">
				<thead>
					<th class="col-md-2">Title</th>
					<th class="col-md-5">Content</th>
					<th class="col-md-2">Image</th>
					@if($logged->can('Edit'))
					<th class="col-md-1"></th>
					@endif
					<th class="col-md-2">Actions</th>
				</thead>
				<tbody>
					@foreach($carousels as $carousel)
						<tr>
							<td>{{ str_limit($carousel->title, 20, ' ...') }}</td>
							<td>{{ str_limit($carousel->description, 50, ' ...') }}</td>
							<td>
								@if(isset($carousel->img_src) && !empty($carousel->img_src))
									<img class="img-responsive" src="{{ asset("uploads/$carousel->img_src") }}" alt="" width="85" height="64" />
								@else
									<img src="http://placehold.it/85x64" alt="" width="85" height="64" />
								@endif
							</td>
							@if($logged->can('Edit'))
							<td>
								@if($carousel->status == 1)
									<a onClick="return confirm('Disable?')" href="{{ URL::route("carousels.disable", "id=$carousel->id_carousel") }}" class="btn btn-success"><i class="fa fa-check"></i> </a>
								@else
									<a onClick="return confirm('Enable?')" href="{{ URL::route("carousels.enable", "id=$carousel->id_carousel") }}" class="btn btn-danger"><i class="fa fa-times"></i> </a>
								@endif
							</td>
							@endif
							<td>
								{{Form::open(array('url' => URL::route('carousels.destroy', $carousel->id_carousel), 'method' => 'delete'))}}
									@if($logged->can('Edit')) 
										<a href="{{ URL::route("carousels.edit", $carousel->id_carousel) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
									@endif
									@if($logged->can('Delete')) 
										<button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
									@endif
								{{Form::close()}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $carousels->links() }}
		@else
			<p class="alert alert-danger">Sorry, no slides to show.</p>
		@endif
	</div>
@stop