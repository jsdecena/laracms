{{-- USERS EDIT BLADE --}}

@extends('admin.tpl.main')

@section('body')
    <div id="content-body">
	    {{-- CHECK IF THERE IS A SESSION MESSAGE FOR FAILED ATTEMPT --}}
	    @if($errors->all())
	        <ul class="list-unstyled">
	            @foreach($errors->all() as $error)
	                <li class="alert alert-danger">
	                    <button type="button" class="close" data-dismiss="alert">&times;</button>
	                    {{ $error }}
	                </li>
	            @endforeach
	        </ul>
	    @endif

		{{ Form::open(array('url' => URL::route("users.update", $user->id_user), 'role' => 'form', 'method' => 'put')) }}
			<div class="form-group">
				<label for="firstname">First Name <sup class="text text-danger">*</sup></label>
				<input name="firstname" type="text" class="form-control" id="firstname" value="{{{ isset($user->firstname) ? $user->firstname : Input::old('firstname') }}}">
			</div>
			<div class="form-group">
				<label for="lastname">Last Name</label>
				<input name="lastname" type="text" class="form-control" id="lastname" value="{{{ isset($user->lastname) ? $user->lastname : Input::old('lastname') }}}">
			</div>
			<div class="form-group">
				<label for="email">Email Address</label>
				<input name="email" type="email" class="form-control" id="email" value="{{{ isset($user->email) ? $user->email : Input::old('email') }}}">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input name="password" type="text" class="form-control" id="password" value="" />
				<span class="text text-danger">Leave blank if not changing password</span>
			</div>
			<div class="form-group">
				<label for="role">Role</label>
				<select class="form-control" name="role" id="role">
					<option value=""></option>
					@foreach($roles as $role)
					<option @if( Input::old('role') == $role->id_role || $user->id_role == $role->id_role ) selected @endif value="{{$role->id_role}}"> {{$role->role}} </option>
					@endforeach
				</select>
			</div>
			<div class="btn-group">
				<a href="{{ URL::route('users.index') }}" class="btn btn-default">Go Back</a>
				<button type="submit" class="btn btn-primary" name="edit">Submit</button>
			</div>		
		{{ Form::close() }}
	</div>
@stop