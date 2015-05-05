{{-- PAGES EDIT BLADE --}}

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
				<label for="category">Title <sup class="text text-danger">*</sup></label>
				<input name="category" type="text" class="form-control" id="category" value="{{{ isset($category->category) ? $category->category : Input::old('category') }}}">
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
				<a href="{{ URL::to('admin/categories/list') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="add" type="submit">Add Page</button>
			</div>
		{{ Form::close() }}
	</div>
@stop