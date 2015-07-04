<?php

class SettingsController extends \AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('role');

		$this->table = "settings";
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['pages'] 			= Posts::pages()->orderBy('created_at', 'DESC')->get();
		$data['WEBSITE_NAME'] 	= DB::table($this->table)->where('settings_name', 'WEBSITE_NAME')->pluck('settings_value');
		$data['POSTS_PER_PAGE'] = DB::table($this->table)->where('settings_name', 'POSTS_PER_PAGE')->pluck('settings_value');
		$data['ORDER_BY'] 		= DB::table($this->table)->where('settings_name', 'ORDER_BY')->pluck('settings_value');
		$data['ARRANGE_BY'] 	= DB::table($this->table)->where('settings_name', 'ARRANGE_BY')->pluck('settings_value');
		$data['POST_IN_PAGE'] 	= DB::table($this->table)->where('settings_name', 'POST_IN_PAGE')->pluck('settings_value');

		$this->layout->content 	= View::make('admin.settings', $data);
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
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'POST_IN_PAGE'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :

			return Redirect::route('settings.index')->withErrors($validator);
		else:

			//GET ALL THE POST DATA
			$posts = Input::except('_token');

			//LOOP THE POST DATA AND UPDATE
			foreach ($posts as $key => $value) {
				$this->updateSettings($key, $value);
			}
			
			return Redirect::route('settings.index')->with('success', 'Your settings are successfully saved!');
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
		//
	}

	public function updateSettings($key, $value)
	{
		DB::table($this->table)
	            ->where('settings_name', $key)
	            ->update(array('settings_value' => $value));
	}	
}
