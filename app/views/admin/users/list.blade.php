{{-- USERS LIST BLADE --}}

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
	    
	 	@if( isset($users) && !$users->isEmpty() )    
			<table class="table table-striped">
				<thead>
					<th class="col-md-1">ID</th>
					<th class="hidden-xs col-md-2">First Name</th>
					<th class="hidden-xs col-md-2">Last Name</th>
					<th class="col-md-2">Email</th>
					<th class="hidden-xs col-md-2">Role</th>
					<th class="col-md-1">Status</th>
					<th class="col-md-2">Actions</th>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->id_user }}</td>
						<td class="hidden-xs">{{ $user->firstname }}</td>
						<td class="hidden-xs">{{ $user->lastname }}</td>
						<td>{{ $user->email }}</td>
						<td class="hidden-xs">@if( !empty($user->id_role) ) {{ Roles::ofIdRole($user->id_role)->get()[0]->role }} @endif </td>
						<td id="status">
							@if( $user->status == 1 )
								<a href="{{ URL::to("admin/users/disable/$user->id_user") }}" class="btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }} "><i class="fa fa-check"></i></a>
							@else
								<a href="{{ URL::to("admin/users/enable/$user->id_user") }}" class="btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="fa fa-times"></i></a>
							@endif					
						</td>
						<td id="delete">
							<a href="{{ URL::to("admin/users/edit/$user->id_user") }}" class="btn btn-primary {{ $logged->can('Edit') ? '' : 'disabled' }}"><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{ URL::to("admin/users/delete/$user->id_user") }}" class="btn btn-danger {{ $logged->can('Delete') ? '' : 'disabled' }}"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $users->links() }}
		@else
			<p class="alert alert-danger">Sorry, not page to show.</p>
		@endif
	</div>
@stop