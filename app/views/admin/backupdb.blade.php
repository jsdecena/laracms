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

    	{{ Form::open(array('url' => Request::path(), 'role' => 'form')) }}
    		<div class="form-group">
    			<label for="backupdb">Backup your database now</label>
    			<select name="backupdb" id="backupdb" class="form-control">
                    @foreach($dbtables as $dbtable)
                    <option value="{{ $dbtable }}">{{ $dbtable }}</option>
                    @endforeach
    			</select>
    		</div>
    		<div class="btn-group">
    			<a href="{{ URL::to('admin') }}" class="btn btn-default">Go back</a>
    			<button class="btn btn-primary" name="backup" type="submit">Backup Now</button>
    		</div>
    	{{ Form::close() }}
    </div>
@stop