@extends('front.'.$theme.'.tpl.main')

@section('body')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">{{$page->content}}</div>
        </div>
    </div>
@stop