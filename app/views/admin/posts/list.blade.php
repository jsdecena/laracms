@extends('admin.tpl.main')

@section('body')
	<div id="content-body">
		
		@include('messages')
	    
	    @if( isset($posts) && !empty($posts) )
			<table class="table table-striped">
				<thead>
					<th class="col-md-1">ID</th>
					<th class="col-md-2">Title</th>
					<th class="hidden-xs col-md-4">Content</th>
					<th class="hidden-xs col-md-2">Category</th>
					<th class="col-md-1">Status</th>
					<th class="col-md-2">Actions</th>
				</thead>
				<tbody>
					@foreach($posts_categories as $post)
					<tr>
						<td>{{ $post['post']->id_post }}</td>
						<td>{{ $post['post']->title }}</td>
						<td class="hidden-xs">{{ str_limit($post['post']->content, 150, ' ...') }}</td>
						<td class="hidden-xs">
							@foreach($post['categories'] as $category)
								<span class="label label-default">{{$category->name}}</span>&nbsp;
							@endforeach
						</td>
						@if($logged->can('Edit'))
						<td id="status">
							@if( $post['post']->status == '1' )
								<a onClick="return confirm('Are you sure you want to disable?')" href="{{ URL::route("posts.disable", "id=" . $post['post']->id_post) }}" class="btn btn-success"><i class="fa fa-check"></i></a>
							@else
								<a onClick="return confirm('Are you sure you want to enable?')" href="{{ URL::route("posts.enable", "id=" . $post['post']->id_post) }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
							@endif
						</td>
						@endif
						<td>
							{{Form::open(array('url' => URL::route('posts.destroy', $post['post']->id_post), 'method' => 'delete'))}}
								@if($logged->can('Edit'))<a href="{{URL::route('posts.edit', $post['post']->id_post)}}" class="btn btn-primary"><i class='glyphicon glyphicon-pencil'></i></a>@endif
								@if($logged->can('Delete'))
									<button onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger"><i class='glyphicon glyphicon-trash'></i></button>
								@endif
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		{{ $posts->links() }}
		@else
			<p class="alert alert-danger">Sorry, not post to show.</p>
		@endif
	<div id="content-body">
@stop