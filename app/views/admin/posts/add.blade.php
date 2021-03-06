{{-- POSTS ADD BLADE --}}

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

		{{ Form::open(array('url' => URL::route('posts.store'), 'role' => 'form', 'files' => true)) }}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="title">Title <sup class="text text-danger">*</sup></label>
						<input name="title" type="text" class="form-control" id="title" value="{{ Input::old('title') }}">
					</div>
					<div class="form-group">
						<label for="content">Content</label>
						<textarea name="content" id="content" class="form-control ckeditor">{{ Input::old('content') }}</textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="img_src">Featured Image</label>
						<input name="userfile" type="file" class="form-control" id="img_src" value="" />
					</div>			
					<div class="form-group">
						<label for="status">Status</label>
						<select name="status" id="status" class="form-control">
							<option value="0">Disabled</option>
							<option value="1">Enabled</option>				
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="status">Categories</label>
						<ul id="checkbox-list" style="list-style-type:none; padding:0px; ">
							@foreach($categories as $category)
								<li> <input type="checkbox" class="form-control" name="categories[]" value="{{$category->id_category}}"/> {{$category->name}}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="btn-group">
				<a href="{{ URL::to('admin/pages/list') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="add" type="submit">Add Post</button>
			</div>
		{{ Form::close() }}
	</div>
@stop