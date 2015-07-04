<?php

class UsersController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//CURRENT LOGGED USER
		$data['logged']			=  User::find(Auth::id());
		
		//QUERY ALL THE USERS
		$data['users']			=  User::orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));

		$this->layout->content 	=  View::make('admin.users.list', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['uri'] 			= Request::path();
		$data['roles']          = Roles::active()->orderBy('created_at', 'DESC')->get();
		$this->layout->content 	= View::make('admin.users.add', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'firstname'			=> 'required',
			'email'				=> 'required|email|unique:users',
			'password'			=> 'required|min:8',
			'role'				=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::route('users.create')->withErrors($validator)->withInput(Input::except('password'));
		else:

			$user 				= new User;
			$user->firstname 	= Input::get('firstname');
			$user->lastname 	= Input::get('lastname');
			$user->email 		= Input::get('email');
			$user->password 	= Hash::make(Input::get('password'));
			$user->id_role      = Input::get('role');
			$user->status 		= Input::get('status');
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

			return Redirect::route('users.index')->withInput(Input::except('password'))->with('success', 'You have added a new user!');
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
		$data['user'] 			= User::find($id);
		$data['roles']          = Roles::active()->orderBy('created_at', 'DESC')->get();
		$this->layout->content 	= View::make('admin.users.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'firstname'			=> 'required',
			'email'				=> 'required|email'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['user'] 			= User::find($id);

		if ($validator->fails()) :

			return Redirect::route('users.edit', $id)->withErrors($validator)->withInput(Input::except('password'));
		else:

			if ( Input::has('password')) :

				//IF THE PASSWORD FIELD IS FILLED, UPDATE THIS USERS PASSWORD
				$user 				= User::find($id);
				$id_role			= $user->id_role;

				$user->firstname 	= Input::get('firstname');
				$user->lastname 	= Input::get('lastname');
				$user->email 		= Input::get('email');
				$user->password 	= Hash::make(Input::get('password'));
				$user->id_role 		= Input::get('role');
				$user->save();

				//DELETE USER'S PERMISSION ON USERS_PERMISSIONS
				$users_permissions  = Users_Permissions::where('id_user', '=', $id)->delete();

				$new_id_role 		= $user->id_role;
				$permissions        = array_fetch(Roles::find($new_id_role)->permissions->toArray(), 'id_permission');

				for ($i=0; $i < count($permissions); $i++) :
					$data = array(

						'id_user'   		=> $id,
						'id_permission' 	=> $permissions[$i]
					
					);

					$users_permissions  = Users_Permissions::create($data);
				endfor;


				return Redirect::route('users.edit')->withInput(Input::except('password'))->with('success', 'You have changed the password for this user.');
			else:
				//IF THE PASSWORD FIELD IS NOT FILLED, UPDATE THE CREDENTIALS EXCEPT FOR THE PASSWORD
				$user 				= User::find($id);
				$id_role			= $user->id_role; 

				$user->firstname 	= Input::get('firstname');
				$user->lastname 	= Input::get('lastname');
				$user->email 		= Input::get('email');
				$user->id_role 		= Input::get('role');
				$user->save();

				$users_permissions  = Users_Permissions::where('id_user', '=', $id)->delete();

				$new_id_role 		= $user->id_role;
				$permissions        = array_fetch(Roles::find($new_id_role)->permissions->toArray(), 'id_permission');

				for ($i=0; $i < count($permissions); $i++) :
					$data = array(

						'id_user'   		=> $id,
						'id_permission'  	=> $permissions[$i]
					
					);

					$users_permissions  = Users_Permissions::create($data);
				endfor;
				return Redirect::route('users.index')->withErrors($validator)->withInput(Input::except('password'))->with('success', 'You have successfully edited this user.');
			endif;
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
		$user = User::find($id);
		$user->delete();

		return Redirect::route('users.index')->with('success', 'You have successfully deleted a user.');
	}

	public function account()
	{
		$data['user'] 			= User::find(Input::get('id'));
		$this->layout->content 	= View::make('admin.users.myaccount', $data);		
	}

	public function accountUpdate()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'firstname'			=> 'required',
			'email'				=> 'required|email'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :

			return Redirect::route('users.account', Input::get('id'))->withErrors($validator)->withInput(Input::except('password'));
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
			return Redirect::route('users.account', "id=" . Auth::id())->with('success', 'You have successfully edited your account.');
		endif;
	}

	public function enable()
	{
		//QUICK ENABLE PAGE
		$user 				= User::find(Input::get('id'));
		$user->status 		= 1;
		$user->save();

		return Redirect::route('users.index')->with('success', 'You have enabled the user.');
	}

	public function disable()
	{
		//QUICK ENABLE PAGE
		$user 				= User::find(Input::get('id'));
		$user->status 		= 0;
		$user->save();

		return Redirect::route('users.index')->with('success', 'You have disabled the user.');
	}	

}