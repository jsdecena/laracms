{{-- MODULES/CAROUSEL EDIT BLADE --}}

@extends('admin.tpl.main')

@section('body')
    
    <div id="content-body">
	
	    <h3>Edit a Slide</h3> <hr>

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

		{{ Form::open(array('url' => Request::path(), 'role' => 'form', 'files' => true)) }}
			<div class="form-group">
				<label for="title">Title <sup class="text text-danger">*</sup></label>
				<input name="title" type="text" class="form-control" id="title" value="{{{ isset($slide->title) ? $slide->title : Input::old('title') }}}">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control ckeditor" rows="5">{{{ isset($slide->description) ? $slide->description : Input::old('description') }}}</textarea>
			</div>
			<div class="form-group">
				<label>Featured Image</label> <br />
				@if(isset($slide->img_src) && !empty($slide->img_src))
					<img src="{{ asset("uploads/$slide->img_src") }}" alt="" width="85" height="64" />
				@else
					<img src="{{ asset("uploads/no-photo.jpg") }}" alt="" width="85" height="64" />
				@endif
			</div>
			<div class="form-group">
				<label for="img_src">Slide</label>
				<input type="file" name="userfile" id="img_src" class="form-control" />
			</div>
			<div class="form-group">
				<label for="link">Link</label>
				<input name="link" type="text" class="form-control" id="link" placeholder="http://" value="{{{ isset($slide->link) ? $slide->link : Input::old('link') }}}">
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" id="status" class="form-control">
					<option value="0">Disabled</option>
					<option value="1">Enabled</option>
				</select>
			</div>		
			<div class="btn-group">
				<a href="{{ URL::to('admin/modules/carousels/list') }}" class="btn btn-default">Go Back</a>
				<button type="submit" class="btn btn-primary" name="edit">Submit</button>
			</div>		
		{{ Form::close() }}
	</div>
@stop