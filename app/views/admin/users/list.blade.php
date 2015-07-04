{{-- USERS LIST BLADE --}}

@extends('admin.tpl.main')

@section('body')
	<div id="content-body">
		
		@include('messages')

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
						@if($logged->can('Edit'))
						<td id="status">
							@if( $user->status == 1 )
								<a onClick="return confirm('Are you sure?')" href="{{ URL::route("users.disable", "id=$user->id_user") }}" class="btn btn-success"><i class="fa fa-check"></i></a>
							@else
								<a onClick="return confirm('Are you sure?')" href="{{ URL::route("users.enable", "id=$user->id_user") }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
							@endif					
						</td>
						@endif
						<td id="delete">
							{{Form::open(array('url' => URL::route("users.destroy", $user->id_user), 'method' => 'delete'))}}
								@if($logged->can('Edit'))<a href="{{ URL::route("users.edit", $user->id_user) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>@endif
								@if($logged->can('Delete'))<button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>@endif
							{{Form::close()}}
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