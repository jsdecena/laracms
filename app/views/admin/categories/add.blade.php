@extends('admin.tpl.main')

@section('body')
    
    <div id="content-body">

		{{ Form::open(array('url' => URL::route('categories.store'), 'role' => 'form')) }}
			
			<div class="form-group">
				<label for="category">Title <sup class="text text-danger">*</sup></label>
				<input name="category" type="text" class="form-control" id="category" value="{{ Input::old('category') }}">
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
				<a href="{{ URL::to('admin/pages/list') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="add" type="submit">Add Category</button>
			</div>
		{{ Form::close() }}
	</div>
@stop