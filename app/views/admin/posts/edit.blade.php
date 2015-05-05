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

	{{ Form::open(array('url' => Request::path(), 'role' => 'form', 'files' => true)) }}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="title">Title</label>
					<input name="title" type="text" class="form-control" id="title" value="{{{ isset($post->title) ? $post->title : Input::old('title') }}}">
				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="content" class="form-control ckeditor">{{{ isset($post->content) ? $post->content : Input::old('content') }}}</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div id="delete" class="form-group">
					<label>Featured Image</label> <br />
					@if(!empty($post->img_src))
						<img src="{{ asset("uploads/$post->img_src") }}" alt="" class="img-thumbnail" width="85" height="85" />
					@else
						<img src="{{ asset("uploads/no-photo.jpg") }}" alt="" class="img-thumbnail" width="85" height="85" />
					@endif
					<a href="#" @if(!empty($post->img_src)) class="btn btn-danger" @else class="btn btn-danger hidden" @endif>Delete</a>
				</div>
				<div class="form-group"><input name="userfile" type="file" class="form-control" id="img_src" value="" /></div>
				
				<div class="form-group">
					<label for="status">Status</label>
					<select name="status" id="status" class="form-control">
						<option @if( isset($post->status) && $post->status == 1 ) selected="selected" @endif value="1">Enabled</option>
						<option @if( isset($post->status) && $post->status == 0 ) selected="selected" @endif value="0">Disabled</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="status">Categories</label>
					<ul id="checkbox-list" style="list-style-type:none; padding:0px; ">
						@foreach($categories as $category)
							<li> <input type="checkbox" class="form-control" name="categories[]" @if( in_array($category->id_category, $post_categories_arr) ) checked @endif value="{{$category->id_category}}"/> {{$category->category}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="btn-group">
			<a href="{{ URL::to('admin/posts/list') }}" class="btn btn-default">Go back</a>
			<button class="btn btn-primary" name="edit" type="submit">Update post</button>
		</div>
	{{ Form::close() }}
	</div>
@stop