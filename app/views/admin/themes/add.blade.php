{{-- THEMES ADD BLADE --}}

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

		{{ Form::open(array('url' => $uri, 'role' => 'form', 'files' => true)) }}
			
			<div class="form-group">
				<label for="them">Upload Theme <sup class="text text-danger">*</sup></label>
				<input name="theme" type="file" class="form-control" id="theme" accept=".zip" value="{{ Input::old('theme') }}">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control ckeditor">{{ Input::old('description') }}</textarea>
			</div>	
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" id="status" class="form-control">
					<option value="0">Disabled</option>
					<option value="1">Enabled</option>				
				</select>
			</div>
			<div class="btn-group">
				<a href="{{ URL::to('admin/themes/list') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="add" type="submit">Add Theme</button>
			</div>
		{{ Form::close() }}
	</div>
@stop