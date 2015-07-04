<?php

class AdminController extends BaseController {

	public $post_type;	

	public function __construct()
	{
		if (Auth::check()) :

			$user 					= User::find(Auth::id());
			
			View::share(array(
					'name' 			=> (isset($user->firstname)) ? $user->firstname . ' ' . $user->lastname : null,
					'profile_img'	=> $user->img_src,
					'since'			=> date('F m Y', strtotime($user->created_at)),
					'logged'		=> $user,
					'website_name'  => $this->settingsValue('WEBSITE_NAME')
				));
		endif;

		$this->beforeFilter('permission');

		$this->layout 	= 'admin.tpl.main';		
	}

	public function getIndex()
	{
		$this->getDashboard();
	}

	public function getDashboard()
	{
		if (Auth::check()) :
			
			$this->layout->content 	= View::make('admin.index');
		else:
			return Redirect::to('login')->with('error', 'Sorry, you need to login to view this page.');
		endif;
	}	

	public function getSettings()
	{
		$data['pages'] 			= Posts::pages()->orderBy('created_at', 'DESC')->get();
		$this->layout->content 	= View::make('admin.settings', $data);
	}

	public function settingsValue($key)
	{
		$data['settings'] 					= DB::table('settings')->where('settings_name', $key)->pluck('settings_value');	

		$val = null;
		foreach ($data as $value) {
			$val = $value;
		}
		return $val;
	}

	public function getBackupdb()
	{
		//GET THE CURRENT DATABASE
		$database = Config::get('database');

		$dbname = array();
		$namedb = array();
		foreach ($database as $db) {
			$dbname[] = $db;
		}

		foreach ($dbname as $name) {
			$namedb[] = $name; 
		}

		//QUERY ALL THE DATABASE TABLES
		$i = DB::select( DB::raw("SELECT * from information_schema.tables WHERE table_schema='". $namedb[2]['mysql']['database'] ."'") );

		$table = array();
		foreach ($i as $value) {
			$table[] = $value->TABLE_NAME;
		}

		$data['dbtables']		= $table;
		$data['pages'] 			= Posts::pages()->orderBy('created_at', 'DESC')->get();		
		$this->layout->content 	= View::make('admin.backupdb', $data);
	}

	public function postBackupdb()
	{
		\Iseed::generateSeed(Input::get('backupdb'));

		return Redirect::to('admin/backupdb')->with('success', 'You have successfully backup your database!');
	}	
}
