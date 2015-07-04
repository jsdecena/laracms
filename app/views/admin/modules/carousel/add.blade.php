{{-- MODULES/CAROUSEL ADD BLADE --}}

@extends('admin.tpl.main')

@section('body')
    
    <div id="content-body">
	
	    <h3>Add a Slide</h3> <hr>

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

		{{ Form::open(array('url' => URL::route('carousels.store'), 'role' => 'form', 'files' => true)) }}
			<div class="form-group">
				<label for="title">Title</label>
				<input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{Input::old('title')}}">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control ckeditor" rows="5" placeholder="Description">{{Input::old('description')}}</textarea>
			</div>
			<div class="form-group">
				<label for="img_src">Slide</label>
				<input type="file" name="userfile" id="img_src" class="form-control" />
			</div>
			<div class="form-group">
				<label for="link">Link </label>
				<input name="link" type="text" class="form-control" id="link" placeholder="http://" value="" />
			</div>		
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" id="status" class="form-control">
					<option value="0">Disabled</option>
					<option value="1">Enabled</option>				
				</select>
			</div>		
			<div class="btn-group">
				<a href="{{ URL::route('carousels.index') }}" class="btn btn-default">Go Back</a>
				<button type="submit" class="btn btn-primary" name="add">Submit</button>
			</div>		
		{{ Form::close() }}
	</div>
@stop