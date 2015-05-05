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

                               	{{ Form::open( array('url' => $uri, 'role' => 'form') ) }}
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
                                <button class="btn btn-block btn-primary {{ $logged->can('Create') ? '' : 'disabled' }}" name="add" type="submit"><i class="fa fa-plus"></i> Add Role</button>
                                <!-- Navigation - folders-->
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
                                        		<th>Status</th>
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
    		                                        <td id="status">
                                						@if( $role['role']->status == '1' )
                                							<a href="/admin/users/roles/disable/{{$role['role']->id_role }}"  class='btn btn-success {{ $logged->can('Edit') ? '' : 'disabled' }}'><i class='fa fa-check'></i></a>
                                						@else
                                							<a href="/admin/users/roles/enable/{{$role['role']->id_role}}"class='btn btn-danger {{ $logged->can('Edit') ? '' : 'disabled' }}'><i class='fa fa-times'></i></a>
                                						@endif
                                					</td>
    		                                        <td id="delete">

                                						<a href="/admin/users/roles/edit/{{$role['role']->id_role}}" class='btn btn-primary {{ $logged->can('Edit') ? '' : 'disabled' }} '><i class='glyphicon glyphicon-pencil'></i></a>
                                						@if( $role['role']->id_role != '1' )
                                                            <a href="/admin/users/roles/delete/{{$role['role']->id_role}}" class='btn btn-danger {{ $logged->can('Delete') ? '' : 'disabled' }}'><i class="glyphicon glyphicon-trash"></i></a>
                                					    @endif
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