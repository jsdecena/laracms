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

			<div class="form-group">
				<label for="WEBSITE_NAME">Website Name :</label>
				<input type="text" class="form-control" id="WEBSITE_NAME" name="WEBSITE_NAME" value="{{$WEBSITE_NAME}}">
			</div>
			<div class="form-group">
				<label for="POSTS_PER_PAGE">Posts and Pages per page :</label>
				<input type="text" class="form-control" id="POSTS_PER_PAGE" name="POSTS_PER_PAGE" placeholder="10" value="{{$POSTS_PER_PAGE}}">
			</div>
			<div class="form-group">
				<label for="ORDER_BY">Order post by :</label>
				<select name="ORDER_BY" id="ORDER_BY" class="form-control">
					<option value="created_at" @if($ORDER_BY == "created_at") selected="selected" @endif>Created Date</option>
					<option value="title" @if($ORDER_BY == "title") selected="selected" @endif>Title</option>
				</select>
			</div>
			<div class="form-group">
				<label for="ARRANGE_BY">Arrange post by :</label>
				<select name="ARRANGE_BY" id="ARRANGE_BY" class="form-control">
					<option value="DESC" @if($ARRANGE_BY == "DESC") selected="selected" @endif>Descending</option>
					<option value="ASC" @if($ARRANGE_BY == "ASC") selected="selected" @endif>Ascending</option>
				</select>
			</div>

			<div class="form-group">
				<label for="POST_IN_PAGE">Show posts in :</label>
				<select name="POST_IN_PAGE" id="POST_IN_PAGE" class="form-control">
					@foreach( $pages as $page)
						<option value="{{ $page->id_post }}" @if($POST_IN_PAGE == $page->title) selected="selected" @endif> {{ $page->title }} </option>
					@endforeach
				</select>
			</div>			
			<div class="btn-group">
				<a href="{{ URL::to('admin') }}" class="btn btn-default">Go back</a>
				<button class="btn btn-primary" name="save" type="submit">Save Settings</button>
			</div>
		{{ Form::close() }}
	</div>
@stop