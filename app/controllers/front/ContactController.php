<?php

class ContactController extends FrontController {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['uri'] 			= Request::path();
		$this->layout->content 	= View::make('front.'.$this->theme->theme.'.contact', $data);
	}

	public function submit()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'name'			=> 'required',
			'email'			=> 'required|email',
			'message'		=> 'required',
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();

		if ($validator->fails()) :
			return Redirect::to(Request::path())->withErrors($validator);
		else:

			$data = array(
						'name' 		=> Input::get('name'),
						'email' 	=> Input::get('email'),
						'contact' 	=> Input::get('contact'),
						'message' 	=> Input::get('message')
					);
			Mail::pretend('emails.contact', $data, function($message) use ($data)
			{
				$message->from(Input::get('email'), Input::get('name'));
			    $message->to('john@doe.com', 'John Doe')->subject('Inquiry');
			});

			return Redirect::to(Request::path())->with('success', 'You have successfully sent an email to us.');
		endif;
	}
}
