
{{-- POST LIST BLADE --}}

@extends('admin.tpl.main')

@section('body')
	<div id="content-body">
	    @if(Session::get('success'))
	        <p class="alert alert-success">
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	            {{ Session::get('success') }}
	        </p>
	    @elseif(Session::get('error'))
	        <p class="alert alert-danger">
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	            {{ Session::get('error') }}
	        </p>
	    @endif
	    
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
								<span class="label label-default">{{$category->category}}</span>&nbsp;
							@endforeach
						</td>

						<td id="status">
							@if( $post['post']->status == '1' )
								<a href="/admin/posts/disable/{{$post['post']->id_post}}"  class='btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }}'><i class='fa fa-check'></i></a>
							@else
								<a href="/admin/posts/enable/{{$post['post']->id_post}}"class='btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }} '><i class='fa fa-times'></i></a>
							@endif
						</td>
						<td id="delete">
							<a href="/admin/posts/edit/{{$post['post']->id_post}}" class='btn btn-primary {{ $logged->can('Edit') ? '' : 'disabled' }}'><i class='glyphicon glyphicon-pencil'></i></a>
							<a href="/admin/posts/delete/{{$post['post']->id_post}}" class='btn btn-danger {{ $logged->can('Delete') ? '' : 'disabled' }}'><i class="glyphicon glyphicon-trash"></i></a>
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