<?php

class SettingsController extends AdminController {

	public $table;

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('role');
		$this->beforeFilter('permission');

		$this->table = "settings";
	}

	public function getIndex()
	{
		$data['pages'] 			= Posts::pages()->orderBy('created_at', 'DESC')->get();
		$data['WEBSITE_NAME'] 	= DB::table($this->table)->where('settings_name', 'WEBSITE_NAME')->pluck('settings_value');
		$data['POSTS_PER_PAGE'] = DB::table($this->table)->where('settings_name', 'POSTS_PER_PAGE')->pluck('settings_value');
		$data['ORDER_BY'] 		= DB::table($this->table)->where('settings_name', 'ORDER_BY')->pluck('settings_value');
		$data['ARRANGE_BY'] 	= DB::table($this->table)->where('settings_name', 'ARRANGE_BY')->pluck('settings_value');
		$data['POST_IN_PAGE'] 	= DB::table($this->table)->where('settings_name', 'POST_IN_PAGE')->pluck('settings_value');

		$this->layout->content 	= View::make('admin.settings', $data);
	}

	public function postSettings()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'POST_IN_PAGE'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator);
		else:

			//GET ALL THE POST DATA
			$posts = Input::except('_token');

			//LOOP THE POST DATA AND UPDATE
			foreach ($posts as $key => $value) {
				$this->update($key, $value);
			}
			
			return Redirect::to('admin/settings')->with('success', 'Your settings are successfully saved!');
		endif;		
	}

	public function update($key, $value)
	{
		DB::table($this->table)
	            ->where('settings_name', $key)
	            ->update(array('settings_value' => $value));
	}
}
