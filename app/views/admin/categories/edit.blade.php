@extends('admin.tpl.main')

@section('body')
    
    <div id="content-body">
    	@include('messages')

		{{ Form::open(array('url' => URL::route('categories.update', $category->id_category), 'role' => 'form', 'method' => 'put')) }}
			
			<div class="form-group">
				<label for="category">Title <sup class="text text-danger">*</sup></label>
				<input name="name" type="text" class="form-control" id="category" value="{{{ isset($category->name) ? $category->name : Input::old('name') }}}">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control ckeditor">{{{ isset($category->description) ? $category->description : Input::old('description') }}}</textarea>
			</div>	
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" id="status" class="form-control">
					<option @if( isset($category->status) && $category->status == 1 ) selected="selected" @endif value="1">Enabled</option>
					<option @if( isset($category->status) && $category->status == 0 ) selected="selected" @endif value="0">Disabled</option>				
				</select>
			</div>
			<div class="btn-group">
				<a href="{{ URL::route('categories.index') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="add" type="submit">Update Category</button>
			</div>
		{{ Form::close() }}
	</div>
@stop