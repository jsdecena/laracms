@extends('admin.tpl.login')

@section('meta-title')
Forgot Password
@stop

@section('body')
    <div class="form-box" id="login-box">
        <div class="header">Forgot Password</div>
        
        {{ Form::open(array('url' => Request::path() )) }}
        
            <div class="body bg-gray">
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
            </div>
            <div class="body bg-gray">
                <p>Fill out your email</p>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ Input::old('email') }}"/>
                </div>
            </div>
            <div class="footer">                                                               
                <button type="submit" class="btn bg-olive btn-block">Retrieve</button>
                <a href="{{ URL::to('login') }}" class="btn btn-default btn-block">Go back</a>  
            </div>
        {{ Form::close() }}
    </div>
@stop