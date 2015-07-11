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

	{{ Form::open(array('url' => URL::route('posts.update', $post->id_post), 'role' => 'form', 'files' => true, 'method' => 'put')) }}
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
					@if(isset($post->img_src))
						<img src="{{ asset("uploads/$post->img_src") }}" alt="" class="img-thumbnail" width="85" height="85" />
						<a onClick="return confirm('Are you sure you want to delete this featured image?')" href="{{URL::route("posts.featured.image.delete", "action=delete_featured_image&amp;filename=$post->img_src&amp;id=$post->id_post")}}" class="btn btn-danger">Delete</a>
					@endif
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
					<ul id="checkbox-list" class="list-unstyled">
						@foreach($categories as $category)
							<li> <input type="checkbox" class="form-control" name="categories[]" @if( in_array($category->id_category, $post_categories_arr) ) checked @endif value="{{$category->id_category}}"/> {{$category->name}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="btn-group">
			<a href="{{ URL::route('posts.index') }}" class="btn btn-default">Go back</a>
			<button class="btn btn-primary" name="edit" type="submit">Update post</button>
		</div>
	{{ Form::close() }}
	</div>
@stop