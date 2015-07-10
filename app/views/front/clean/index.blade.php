@extends('front.'.$theme.'.tpl.main')

@section('body')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @foreach($records as $record)
                    <div class="post-preview">
                        <a href="{{URL::route('post.show', $record['slug'])}}"><h2 class="post-title">{{$record['title']}}</h2></a>
                        <p class="post-meta">Posted by <a href="#">{{$record['author']->firstname}}</a> on {{date('M d Y', strtotime($record['created_at']))}}</p>
                        <div class="post-content">{{Str::limit($record['content'], 80, '...')}}</div>
                    </div>
                    <hr>
                @endforeach
                <!-- Pager -->
                {{--$records->links()--}}
            </div>
        </div>
    </div>

    <hr>
@stop