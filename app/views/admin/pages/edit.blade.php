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

		{{ Form::open(array('url' => URL::route("pages.update", $page->id_post), 'role' => 'form', 'files' => true, 'method' => 'put')) }}
			
			<div class="form-group">
				<label for="title">Title</label>
				<input name="title" type="text" class="form-control" id="title" value="{{{ isset($page->title) ? $page->title : Input::old('title') }}}">
			</div>
			<div class="form-group">
				<label for="content">Content</label>
				<textarea name="content" id="content" class="form-control ckeditor">{{{ isset($page->content) ? $page->content : Input::old('content') }}}</textarea>
			</div>	
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" id="status" class="form-control">
					<option @if( isset($page->status) && $page->status == 1 ) selected="selected" @endif value="1">Enabled</option>
					<option @if( isset($page->status) && $page->status == 0 ) selected="selected" @endif value="0">Disabled</option>
				</select>
			</div>
			<div class="btn-group">
				<a href="{{ URL::route('pages.index') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="edit" type="submit">Update Page</button>
			</div>
			
		{{ Form::close() }}
	</div>
@stop