<?php

class LoginController extends \FrontController {

	public function __construct()
	{
		$this->layout = 'admin.tpl.login';
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->content 	= View::make('admin.login');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function login()
	{
		$rules = array(
			'email'=>'required|email',
			'password'=>'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) :

			if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'), 'status' => 1))) :
				
				$userdata = array(
				    'email'      => Input::get('email'),
				    'password'   => Input::get('password')
				);				
				
				if (Auth::attempt($userdata)) :
					return Redirect::to('admin')->with('message', 'You are now logged in!');
				else:
					return Redirect::route('login.index')->with('error', 'Your email/password combination is incorrect. Please try again.')->withInput(Input::except('password'));
				endif;
			else:
				return Redirect::route('login.index')->with('error', 'Your Account is disabled. Please contact our customer support.')->withInput(Input::except('password'));
			endif;
		else:
			return Redirect::route('login.index')->withErrors($validator)->withInput(Input::except('password'));
		endif;		
	}
	public function logout()
	{
		Auth::logout();
		return Redirect::route('login.index')->with('success', 'Your have been logged out to the application.');
	}

	public function passwordReset()
	{
		$this->layout->content 	= View::make('admin.password');
	}

	public function passwordSubmit()
	{
		$rules = array(
			'email'			=> 'required|email'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :

			return Redirect::route('password.form')->withErrors($validator)->withInput();
		else:

			/*IF THE USER IS EXISTING, SEND THE EMAIL WITH THE CODE*/
			if(User::where('email', Input::get('email'))->count()) :
				
				$token 	= DB::table('users')->where('email', Input::get('email'))->pluck('password_reset');

				$data 	= array('token' => $token);

				Mail::send('emails.auth.reminder', $data, function($message) use ($data)
				{
				    $message->to(Input::get('email'))->subject('Password Reset');
				});
			else:
				return Redirect::route('password.form')->with('error', 'Sorry, we do not recognize you in our system.');
			endif;
		endif;		
	}

	public function passwordResetForm($token)
	{
		if(User::where('password_reset', $token)->count())
			$this->layout->content 	= View::make('admin.password_reset');
		else
			return Redirect::route('login.index')->with('error', 'Sorry, we do not recognize you in our system.');
	}

	public function passwordResetSubmit($token)
	{
		$rules = array(
			'password'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::route('password.reset')->withErrors($validator);
		else:
			
			if(User::where('password_reset', Input::get('password_reset'))->count()) :

				DB::table('users')
				            ->where('password_reset', Input::get('password_reset'))
				            ->update(array('password' => Hash::make(Input::get('password'))));

				return Redirect::route('login.index')->with('success', 'You have successfully changed your password. Please login now.');
			else:
				return Redirect::route('login.index')->with('error', 'Sorry, we do not recognize you in our system.');
			endif;		

		endif;
	}	
}
