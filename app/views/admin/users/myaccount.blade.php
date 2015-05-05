@extends('admin.tpl.main')

@section('body')
    
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

	{{ Form::open(array('url' => Request::path(), 'files' => true, 'role' => 'form')) }}
		<div class="form-group">
			<label for="firstname">First Name</label>
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
			<input name="password" type="password" class="form-control" id="password" value="" />
			<span class="text text-warning">This will logged you out of the system on submit. <br /> </span>
			<span class="text text-danger">Leave blank if not changing password</span>
		</div>
		<div class="form-group">
			<label for="profile">Profile Image</label>
			<input name="userfile" type="file" id="profile" class="form-control" value="" />
		</div>		
		<div class="btn-group">
			<a href="{{ URL::to('admin') }}" class="btn btn-default">Home</a>
			<button type="submit" class="btn btn-primary" name="edit">Submit</button>
		</div>		
	{{ Form::close() }}
@stop