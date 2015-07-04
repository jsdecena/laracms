{{-- USERS ADD BLADE --}}

@extends('admin.tpl.main')

@section('body')
    
    <div id="content-body">
	    @if($errors->all())
	        <ul class="list-unstyled alert alert-danger">
	            @foreach($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    @endif

		{{ Form::open(array('url' => URL::route('users.store'), 'role' => 'form')) }}
			<div class="form-group">
				<label for="firstname">First Name</label>
				<input name="firstname" type="text" class="form-control" id="firstname" value="{{Input::old('firstname')}}">
			</div>
			<div class="form-group">
				<label for="lastname">Last Name</label>
				<input name="lastname" type="text" class="form-control" id="lastname" value="{{Input::old('lastname')}}">
			</div>
			<div class="form-group">
				<label for="email">Email Address</label>
				<input name="email" type="email" class="form-control" id="email" value="{{Input::old('email')}}">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input name="password" type="password" class="form-control" id="password" value="" />
			</div>
			<div class="form-group">
				<label for="role">Role</label>
				<select class="form-control" name="role" id="role">
					@foreach($roles as $role)
					<option @if( Input::old('role') == $role->id_role ) selected @endif value="{{$role->id_role}}">{{$role->role}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select class="form-control" name="status" id="status">
					<option value="0" selected="selected">Disable</option>
					<option value="1">Enable</option>
				</select>
			</div>			
			<div class="btn-group">
				<a href="{{ URL::route('users.index') }}" class="btn btn-default">Go Back</a>
				<button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</div>		
		{{ Form::close() }}
	</div>	
@stop