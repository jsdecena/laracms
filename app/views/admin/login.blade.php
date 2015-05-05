@extends('admin.tpl.login')

@section('meta-title')
Log In
@stop

@section('body')
    <div class="form-box" id="login-box">
        <div class="header">Log In</div>
        
        {{ Form::open(array('url' => Request::path())) }}
        
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
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ Input::old('email') }}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div> 
            </div>
            <div class="footer">                                                               
                <button type="submit" class="btn bg-olive btn-block">Log me in</button>  
                <p><a href="{{ URL::to('password') }}">I forgot my password</a></p>
            </div>
        </form>
    </div>
@stop