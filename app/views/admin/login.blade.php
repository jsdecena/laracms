@extends('admin.tpl.login')

@section('meta-title') Log In @stop

@section('body')
    <div class="form-box" id="login-box">
        <div class="header">Log In</div>
        
        {{ Form::open(array('url' => Request::path())) }}

            <div class="body bg-gray">
                @include('messages')
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