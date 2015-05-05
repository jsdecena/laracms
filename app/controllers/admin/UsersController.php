<?php

class UsersController extends AdminController {


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
		//CURRENT LOGGED USER
		$data['logged']			=  User::find( Auth::id() );
		
		//QUERY ALL THE USERS
		$data['users']			=  User::orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));

		$this->layout->content 	=  View::make('admin.users.list', $data);
	}

	public function getAdd()
	{
		
		$data['uri'] 			= Request::path();
		$data['roles']          = Roles::active()->orderBy('created_at', 'DESC')->get();
		$this->layout->content 	= View::make('admin.users.add', $data);	
	}

	public function postAdd()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'firstname'			=> 'required',
			'email'				=> 'required|email|unique:users',
			'password'			=> 'required|min:8',
			'role'				=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();		

		if ($validator->fails()) :

			return Redirect::to('admin/users/add')->withErrors($validator)->withInput(Input::except('password'));
		else:

			$user 				= new User;
			$user->firstname 	= Input::get('firstname');
			$user->lastname 	= Input::get('lastname');
			$user->email 		= Input::get('email');
			$user->password 	= Hash::make(Input::get('password'));
			$user->id_role      = Input::get('role');
			$user->save();

			$id_user            = $user->id_user;
			$id_role            = $user->id_role;
			$permissions		= array_fetch(Roles::find($id_role)->permissions->toArray(), 'id_permission');
			
			for ($i=0; $i < count($permissions); $i++) :
				$data	= array(
					'id_user'  			=> $id_user,
					'id_permission' 	=> $permissions[$i]
				);

				$users_permissions = Users_Permissions::create($data);
			
			endfor;

			return Redirect::to('admin/users')->withInput(Input::except('password'))->with('success', 'You have added a new user!');
		endif;
	}	

	public function getEdit()
	{
		//CURRENT USER

		$data['user'] 			= User::find(Request::segment(4));
		$data['uri'] 			= Request::path();
		$data['roles']          = Roles::active()->orderBy('created_at', 'DESC')->get();
		$this->layout->content 	= View::make('admin.users.edit', $data);
	}

	public function postEdit()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'firstname'			=> 'required',
			'email'				=> 'required|email'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['user'] 			= User::find(Request::segment(4));
		$data['uri'] 			= Request::path();		

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator)->withInput(Input::except('password'));
		else:

			if ( Input::has('password')) :

				//IF THE PASSWORD FIELD IS FILLED, UPDATE THIS USERS PASSWORD
				$user 				= User::find(Request::segment(4));
				$id_role			= $user->id_role;

				$user->firstname 	= Input::get('firstname');
				$user->lastname 	= Input::get('lastname');
				$user->email 		= Input::get('email');
				$user->password 	= Hash::make(Input::get('password'));
				$user->id_role 		= Input::get('role');
				$user->save();

				//DELETE USER'S PERMISSION ON USERS_PERMISSIONS
				$users_permissions  = Users_Permissions::where('id_user', '=', Request::segment(4))->delete();

				$new_id_role 		= $user->id_role;
				$permissions        = array_fetch(Roles::find($new_id_role)->permissions->toArray(), 'id_permission');

				for ($i=0; $i < count($permissions); $i++) :
					$data = array(

						'id_user'   		=> Request::segment(4),
						'id_permission' 	=> $permissions[$i]
					
					);

					$users_permissions  = Users_Permissions::create($data);
				endfor;


				return Redirect::to('admin/users')->withInput(Input::except('password'))->with('success', 'You have changed the password for this user.');
			else:
				//IF THE PASSWORD FIELD IS NOT FILLED, UPDATE THE CREDENTIALS EXCEPT FOR THE PASSWORD
				$user 				= User::find(Request::segment(4));
				$id_role			= $user->id_role; 

				$user->firstname 	= Input::get('firstname');
				$user->lastname 	= Input::get('lastname');
				$user->email 		= Input::get('email');
				$user->id_role 		= Input::get('role');
				$user->save();

				$users_permissions  = Users_Permissions::where('id_user', '=', Request::segment(4))->delete();

				$new_id_role 		= $user->id_role;
				$permissions        = array_fetch(Roles::find($new_id_role)->permissions->toArray(), 'id_permission');

				for ($i=0; $i < count($permissions); $i++) :
					$data = array(

						'id_user'   		=> Request::segment(4),
						'id_permission'  	=> $permissions[$i]
					
					);

					$users_permissions  = Users_Permissions::create($data);
				endfor;
				return Redirect::to('admin/users')->withErrors($validator)->withInput(Input::except('password'))->with('success', 'You have successfully edited this user.');
			endif;
		endif;
	}

	public function getDelete()
	{
		$user = User::find(Request::segment(4));
		$user->delete();

		return Redirect::to('admin/users/list')->with('success', 'You have successfully deleted a user.');
	}

	public function getMyaccount()
	{
		$data['user'] 			= User::find(Auth::id());
		$data['uri']			= Request::path();
		$this->layout->content 	= View::make('admin.users.myaccount', $data);		
	}

	/*EDITING YOUR PROFILE ACCOUNT*/
	public function postMyaccount()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'firstname'			=> 'required',
			'email'				=> 'required|email'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();		

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$user 				= User::find(Auth::id());
			$user->firstname 	= Input::get('firstname');
			$user->lastname 	= Input::get('lastname');
			$user->email 		= Input::get('email');		
			
			//IF THE USER HAS UPLOADED A PROFILE IMAGE
			if (Input::hasFile('userfile')):

				$path = public_path('uploads');
				$file = Input::file('userfile');

				$newImage = value(function() use ($file){
				    $filename = str_random(10) . '.' . $file->getClientOriginalExtension();
				    return strtolower($filename);
				});

				$upload = $file->move($path, $newImage);

				if($upload):
					$user->img_src 		= $newImage;
				endif;
			endif;

			//JUST CONTINUE UPDATING THE PROFILE WITHOUT THE IMAGE UPLOAD
			if ( Input::has('password')) :

				//IF THE PASSWORD FIELD IS FILLED, UPDATE THIS USERS PASSWORD
				$user->password 	= Hash::make(Input::get('password'));

				Auth::logout();
			endif;

			$user->save();
			return Redirect::to('admin/users/myaccount')->with('success', 'You have successfully edited your account.');
		endif;
	}

	public function getEnable()
	{
		//QUICK ENABLE PAGE
		$user 				= User::find(Request::segment(4));
		$user->status 		= 1;
		$user->save();

		return Redirect::to('admin/users')->with('success', 'You have enabled the page.');
	}

	public function getDisable()
	{
		//QUICK DISABLE PAGE
		$user 				= User::find(Request::segment(4));
		$user->status 		= 0;
		$user->save();

		return Redirect::to('admin/users')->with('error', 'You have disabled the page.');
	}

}
