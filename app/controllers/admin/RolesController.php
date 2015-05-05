<?php

class RolesController extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('role');
		$this->beforeFilter('permission');
	}

	public function getIndex()
	{
		return $this->getList();
		
	}

	public function getList()
	{

		//CURRENT LOGGED USERS
		$data['logged']             = User::find( Auth::id() );
		//QUERY ALL ROLES

		$roles                      = Roles::orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));
		

		//CREATE AN ARRAY OF ROLES WITH THEIR PERMISSIONS
		$roles_permissions_arr 		= array();

		foreach ($roles as $role) :
			$role_arr  = array("role" => $role, "permissions" => Roles::find($role->id_role)->permissions);
			array_push($roles_permissions_arr, $role_arr);
		endforeach;

		$data['roles']     			= $roles_permissions_arr;


		//QUERY ALL PERMISSIONS
		$data['permissions']    	= Permissions::exceptNone()->get();
		$data['uri'] 				= Request::path()."/add";
		$this->layout->content 		= View::make('admin.users.roles.add', $data);
	}

	public function postAdd()
	{
		$rules = array(
			'role' 		=> 'required',
		);

		$validator                  = Validator::make(Input::all(), $rules); 

		if ($validator->fails()) :

			return Redirect::to('/admin/users/roles')->withErrors($validator)->withInput();
		
		else:

			$role                   = new Roles;
			$role->role 			= Input::get('role');
			$role->description  	= Input::get('description');
			$role->status 			= Input::get('status');
			$role->save();

			$id_role 				= $role->id_role;

			$permissions            = Input::get('permissions');

			if( is_array($permissions) ) : 
				//LOOP FOR PERMISSIONS

				for ( $i = 0; $i < count($permissions); $i++ ) :

					$data          = array(

						'id_role' 			=> $id_role,
						'id_permission' 	=> $permissions[$i],
						'created_at'    	=> date('Y-m-d H:i:s'),
						'updated_at'    	=> date('Y-m-d H:i:s')
					);

					$roles_permissions      = Roles_Permissions::create($data);
				
				endfor;

			else : 

					$data          = array(

						'id_role' 			=> $id_role,
						'id_permission' 	=> 5,
						'created_at'    	=> date('Y-m-d H:i:s'),
						'updated_at'    	=> date('Y-m-d H:i:s')
					);

					$roles_permissions      = Roles_Permissions::create($data);

			endif;

			return Redirect::to('admin/users/roles')->with('success', 'You have successfully added a role.');

		endif;


	}
	public function getEdit()
	{
		$data['role']     			= Roles::find(Request::segment(5));
		$data['uri'] 				= Request::path();
		$roles_permissions          = Roles::find(Request::segment(5))->permissions;

		$roles_permissions_arr      = array();

		foreach ($roles_permissions as $permission) :

			array_push($roles_permissions_arr, $permission->id_permission);
		endforeach;

		$data['roles_permissions_arr']  = $roles_permissions_arr;
		$data['permissions']			= Permissions::exceptNone()->get();


		$this->layout->content 	= View::make('admin.users.roles.edit', $data);
	}

	public function postEdit()
	{


		$rules = array(
			'role'			=> 'required'
		);

		$validator                  = Validator::make(Input::all(), $rules);

		if( $validator->fails() ) :

			return  Redirect::to(Request::path())->withErrors($validator)->withInput();
		else:

			$role 					= Roles::find(Request::segment(5));


			$role->role             = Input::get('role');
			$role->description      = Input::get('description');
			$role->status           = Input::get('status');
			$role->updated_at 		= date('Y-m-d H:i:s');	
			$role->save();

			$roles_permissions      = Roles_Permissions::where('id_role', '=', Request::segment(5))->delete();

			$permissions            = Input::get('permissions');

			//GET THE USERS WITH THIS ROLE
			$users_with_role        = array_fetch(User::where('id_role', '=', Request::segment(5))->get()->toArray(), 'id_user');

			//UPDATE PERMISSIONS ON USERS_PERMISSIONS
			for ($i=0; $i < count($users_with_role); $i++ ) :

				$users_permissions = Users_Permissions::where('id_user','=', $users_with_role[$i])->delete();
				if ( is_array($permissions) ) :

					for ($x=0; $x < count($permissions); $x++) :
						
						$data = array(
							'id_user' 		=> $users_with_role[$i],
							'id_permission' => $permissions[$x]
						);

						$users_permissions  = Users_Permissions::create($data); 
						
					endfor;

				else:


					$data = array(
						'id_user' 		=> $users_with_role[$i],
						'id_permission' => 5
					);

					$users_permissions  = Users_Permissions::create($data); 
				endif;
			endfor;


			//UPDATE PERMISSION ON ROLES_PERMISSIONS
			if( is_array($permissions) ) :

				for( $i = 0; $i < count($permissions); $i++ ) :
					
					$data = array(

						'id_role'    		=> Request::segment(5),
						'id_permission'		=> $permissions[$i],
						'created_at'   		=> date('Y-m-d H:i:s'),
						'updated_at'    	=> date('Y-m-d H:i:s')
					);

					$roles_permissions = Roles_Permissions::create($data);
				
				endfor;
			else:

					$data = array(

						'id_role'			=> Request::segment(5),
						'id_permission' 	=> 5,
						'created_at'    	=> date('Y-m-d H:i:s'),
						'updated_at'   	 	=> date('Y-m-d H:i:s')
					); 

					$roles_permissions = Roles_Permissions::create($data);   
			endif;




			return Redirect::to('admin/users/roles')->with('success', 'You have successfully edited a role.');
		endif;
	}

	public function getDelete()
	{

		
		$role = Roles::find(Request::segment(5));

		//GET THE USERS WITH THIS ROLE
		$users_with_role        = array_fetch(User::where('id_role', '=', Request::segment(5))->get()->toArray(), 'id_user');

		for($i = 0; $i < count($users_with_role); $i++ ) :

			$users_permissions = Users_Permissions::find($users_with_role[$i])->delete();
		endfor; 

		$role->delete();

		$users = User::where('role', '=' , Request::segment(5))->update(array('role' => ''));

		return Redirect::to('admin/users/roles')->with('success', 'You have successfully deleted a role.');
	}

	public function getEnable()
	{
		//QUICK ENABLE ROLE
		$role 				= Roles::find(Request::segment(5));
		$role->status 		= 1;
		$role->save();

		return Redirect::to('admin/users/roles')->with('success', 'You have enabled the role.');
	}

	public function getDisable()
	{
		//QUICK DISABLE ROLE
		$role 				= Roles::find(Request::segment(5));
		$role->status 		= 0;
		$role->save();

		return Redirect::to('admin/users/roles')->with('error', 'You have disabled the role.');
	}

}