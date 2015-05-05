{{-- THEMES LIST BLADE --}}

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
        
        @foreach($themes as $theme) 
            <div class="col-md-3">
                <!-- Default box -->
                <div class="box  @if( $theme->status == '1' ) {{'box-primary'}} @endif" >
                    <div class="box-header">
                        <h3 class="box-title">{{$theme->theme}}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <img src='/themes/front/{{$theme->theme}}/img/screenshot.png'  style="width:100%; height:80%;"/>
                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        @if( $theme->status == '0' )
                            <a href="/admin/themes/enable/{{$theme->id_theme}}"  class='btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }}'>Activate</a>
                        @endif
                        
                        <button class="btn btn-danger">Delete</button>
                    </div><!-- /.box-footer-->
                </div><!-- /.box -->
            </div>
        @endforeach
    </div>
@stop