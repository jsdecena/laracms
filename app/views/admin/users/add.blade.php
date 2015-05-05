{{-- USERS ADD BLADE --}}

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

		{{ Form::open(array('url' => Request::path(), 'role' => 'form')) }}
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
					<option value=""></option>
					@foreach($roles as $role)
					<option @if( Input::old('role') == $role->id_role ) selected @endif value="{{$role->id_role}}">{{$role->role}}</option>
					@endforeach
				</select>
			</div>
			<div class="btn-group">
				<a href="{{ URL::to('users') }}" class="btn btn-default">Go Back</a>
				<button type="submit" class="btn btn-primary" name="add">Submit</button>
			</div>		
		{{ Form::close() }}
	</div>	
@stop