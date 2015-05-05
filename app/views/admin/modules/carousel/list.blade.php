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
					<th class="col-md-1"></th>
					<th class="col-md-2">Actions</th>
				</thead>
				<tbody>
					@foreach($carousels as $carousel)
						<tr>
							<td>{{ str_limit($carousel->title, 20, ' ...') }}</td>
							<td>{{ str_limit($carousel->description, 50, ' ...') }}</td>
							<td>
								@if(isset($carousel->img_src) && !empty($carousel->img_src))
									<img src="{{ asset("uploads/$carousel->img_src") }}" alt="" width="85" height="64" />
								@else
									<img src="{{ asset("uploads/no-photo.jpg") }}" alt="" width="85" height="64" />
								@endif
							</td>
							<td id="status">
								@if( $carousel->status == 1 )
									<a href="{{ URL::to("admin/modules/carousels/disable/$carousel->id_carousel") }}" class="btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="fa fa-check"></i> </a>
								@else
									<a href="{{ URL::to("admin/modules/carousels/enable/$carousel->id_carousel") }}" class="btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="fa fa-times"></i> </a>
								@endif
							</td>
							<td id="delete">
								<a href="{{ URL::to("admin/modules/carousels/edit/$carousel->id_carousel") }}" class="btn btn-primary {{ $logged->can('Edit') ? '' : 'disabled' }} "><i class="glyphicon glyphicon-pencil"></i></a>
								<a href="{{ URL::to("admin/modules/carousels/delete/$carousel->id_carousel") }}" class="btn btn-danger {{ $logged->can('Delete') ? '' : 'disabled' }} "><i class="glyphicon glyphicon-trash"></i></a>
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