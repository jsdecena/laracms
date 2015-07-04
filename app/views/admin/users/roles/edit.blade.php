{{-- POSTS EDIT BLADE --}}

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

		{{ Form::open(array('url' => URL::route('roles.update', $role->id_role), 'role' => 'form', 'files' => true, 'method' => 'put')) }}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="role">Role</label>
						<input name="role" type="text" class="form-control" id="title" value="{{{ isset($role->role) ? $role->role : Input::old('role') }}}">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" id="description" class="form-control">{{{ isset($role->description) ? $role->description : Input::old('description') }}}</textarea>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select name="status" class="form-control" id="status">
							<option @if( isset($role->status) && $role->status == 1 ) selected="selected" @endif value="1">Enabled</option>
							<option @if( isset($role->status) && $role->status == 0 ) selected="selected" @endif value="0">Disabled</option>
						</select>
					</div>
					<div class="form-group">
						<label for="permission">Permissions</label>
						<ul id="checkbox-list" style="list-style-type:none; padding:0px; ">
							@foreach($permissions as $permission)
								<li> <input type="checkbox" class="form-control" name="permissions[]" @if( in_array($permission->id_permission, $roles_permissions_arr) ) checked @endif value="{{$permission->id_permission}}"/> {{$permission->permission}}</li>
							@endforeach
						</ul>
					</div>

				</div>
			</div>
		
			<div class="btn-group">
				<a href="{{ URL::route('roles.create') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="edit" type="submit">Update role</button>
			</div>
			
		{{ Form::close() }}
	</div>
@stop