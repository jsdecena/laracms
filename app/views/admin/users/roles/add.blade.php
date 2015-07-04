{{-- USER ROLES BLADE --}}

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
        
     	<div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                               	{{ Form::open( array('url' => URL::route('roles.store'), 'role' => 'form') ) }}
                                <div class="box-header">
                                    <i class="fa fa-users"></i>
                                    <h3 class="box-title">ROLES</h3>
                                </div>
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
                                <div class="box-body">
                                	<div class="form-group">
                                		<label for="role">Role</label>
                                		<input name="role" type="text" class="form-control" id="role" value="{{Input::old('role')}}">
                                	</div>
                                	<div class="form-group">
                                		<label for="role">Description</label>
                                		<textarea name="description" class="form-control" id="description">{{Input::old('description')}}</textarea>
                                		
                                	</div>
                                	<div class="form-group">
                                		<label for="status">Status</label>
                                		<select name="status" id="status" class="form-control">
                                			<option value="0">Disabled</option>
                                			<option value="1">Enabled</option>				
                                		</select>
                                	</div>
                                	<div class="form-group">
                                		<label for="status">Permissions</label><br>
                                		
                                		<ul id="checkbox-list" style="list-style-type:none; padding:0px; margin-top:2px; ">
                                			@foreach($permissions as $permission)	
                                				<li> <input type="checkbox" class="form-control permission-check" name="permissions[]" value="{{$permission->id_permission}}"/> {{ $permission->permission }}</li>
                                			@endforeach
                                
                                		</ul>
                                	</div>
                                </div>
                                <!-- compose message btn -->
                                @if($logged->can('Create'))<button class="btn btn-block btn-primary" name="add" type="submit"><i class="fa fa-plus"></i> Add Role</button>@endif

                       			{{ Form::close() }}
                            </div><!-- /.col (LEFT) -->
                            <div class="col-md-9 col-sm-8">
                                <div class="row pad">
                                  
                                    <div class="col-sm-6 search-form pull-right">
                                        <form action="#" class="text-right">
                                            <div class="input-group">                                                            
                                                <input type="text" class="form-control input-sm" placeholder="Search">
                                                <div class="input-group-btn">
                                                    <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>                                                     
                                        </form>
                                    </div>
                                </div><!-- /.row -->
                               @if( isset($roles) && !empty($roles) )
                                <div class="table-responsive">
                                    <!-- THE MESSAGES -->
                                    <table class="table table-mailbox">
                                        <tbody>
                                        	<tr>
                                        		<th>ID</th>
                                        		<th>Role</th>
                                        		<th>Permissions</th>
                                        		<th>Action</th>
                                        	</tr>

    	                                    @foreach($roles as $role)
    		                                    <tr>
    		                                        <td>{{ $role['role']->id_role }}</td>
    		                                        <td>{{ $role['role']->role }}</td>
    		                                        <td>
                                                        @foreach( $role['permissions'] as $permission )
                                                            <span class="label label-default">{{$permission->permission}}</span>&nbsp;
                                                        @endforeach

                                                    </td>
    		                                        <td>
                                                        {{Form::open(array('url' => URL::route('roles.destroy', $role['role']->id_role), 'method' => 'delete'))}}
                                                            @if($logged->can('Edit'))
                                    						  <a href="{{URL::route('roles.edit', $role['role']->id_role)}}" class='btn btn-primary'><i class='glyphicon glyphicon-pencil'></i></a>
                                                            @endif
                                                            @if($logged->can('Delete'))
                                        						@if( $role['role']->id_role != '1' )
                                                                    <button onClick="return confirm('Are you sure you want to delete this role?')" class='btn btn-danger'><i class="glyphicon glyphicon-trash"></i></button>
                                        					    @endif
                                                            @endif
                                                        {{Form::close()}}
                                                    </td>
    		                                    </tr>
    		                                @endforeach
                              
                                    	</tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                                @else
                                    <p class="alert alert-danger">Sorry, no roles to show.</p>
                                @endif

                            </div><!-- /.col (RIGHT) -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                    
                </div><!-- /.box -->
            </div><!-- /.col (MAIN) -->
        </div>
    </div>    
@stop