<?php

class RolesController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->create();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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
		$this->layout->content 		= View::make('admin.users.roles.add', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'role' 		=> 'required',
		);

		$validator                  = Validator::make(Input::all(), $rules); 

		if ($validator->fails()) :

			return Redirect::route('roles.create')->withErrors($validator)->withInput();
		
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

			return Redirect::route('roles.create')->with('success', 'You have successfully added a role.');

		endif;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['role']     			= Roles::find($id);
		$roles_permissions          = Roles::find($id)->permissions;

		$roles_permissions_arr      = array();

		foreach ($roles_permissions as $permission) :
			array_push($roles_permissions_arr, $permission->id_permission);
		endforeach;

		$data['roles_permissions_arr']  = $roles_permissions_arr;
		$data['permissions']			= Permissions::exceptNone()->get();


		$this->layout->content 	= View::make('admin.users.roles.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'role'			=> 'required'
		);

		$validator                  = Validator::make(Input::all(), $rules);

		if($validator->fails()) :
			return  Redirect::route('roles.edit', $id)->withErrors($validator)->withInput();
		else:

			$role 					= Roles::find($id);
			$role->role             = Input::get('role');
			$role->description      = Input::get('description');
			$role->status           = Input::get('status');
			$role->updated_at 		= date('Y-m-d H:i:s');	
			$role->save();

			$roles_permissions      = Roles_Permissions::where('id_role', $id)->delete();
			$permissions            = Input::get('permissions');

			//GET THE USERS WITH THIS ROLE
			$users_with_role        = array_fetch(User::where('id_role', $id)->get()->toArray(), 'id_user');

			//UPDATE PERMISSIONS ON USERS_PERMISSIONS
			for ($i=0; $i < count($users_with_role); $i++ ) :

				$users_permissions = Users_Permissions::where('id_user', $users_with_role[$i])->delete();
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

						'id_role'    		=> $id,
						'id_permission'		=> $permissions[$i],
						'created_at'   		=> date('Y-m-d H:i:s'),
						'updated_at'    	=> date('Y-m-d H:i:s')
					);

					$roles_permissions = Roles_Permissions::create($data);
				
				endfor;
			else:

					$data = array(

						'id_role'			=> $id,
						'id_permission' 	=> 5,
						'created_at'    	=> date('Y-m-d H:i:s'),
						'updated_at'   	 	=> date('Y-m-d H:i:s')
					); 

					$roles_permissions = Roles_Permissions::create($data);   
			endif;

			return Redirect::route('roles.create')->with('success', 'You have successfully edited a role.');
		endif;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = Roles::find($id);

		if($role->users()->count())
			return Redirect::route('roles.create')->with('error', 'Ooops, this role is being used. You cannot delete.');
		else
			$role->delete();
			return Redirect::route('roles.create')->with('success', 'You have successfully deleted a role.');
	}


}
