@extends('admin.tpl.main')

@section('body')
    @if( Session::get('error') )
    	<p class="alert alert-danger">
    	    <button type="button" class="close" data-dismiss="alert">&times;</button>
    	    {{ Session::get('error') }}
    	</p>
    @endif
@stop