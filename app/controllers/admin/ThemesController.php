<?php

class ThemesController extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('role');
		$this->beforeFilter('permission');
	}

	public function getIndex()
	{
		$this->getList();
	}

	public function getList()
	{
		$data['themes']				= Themes::orderBy('status', 'DESC')->get();
		$this->layout->content 		= View::make('admin.themes.list', $data);
	}

	public function getAdd()
	{
		$data['uri']				= Request::path(); 
		$this->layout->content		= View::make('admin.themes.add', $data);

	}

	public function postAdd()
	{
		$rules  =  array(
			'theme'			=>		'required'
		);

		$validator					= Validator::make(Input::all(), $rules);

		if ( $validator->fails() ) :

			return Redirect::to(Request::path())->withErrors($validator)->withInput();

		else :
			$file 								= Input::file('theme');

			if ( Input::hasFile('theme') ) :	
				//PATH TO PUBLIC/THEMES/FRONT
				$path_to_assets 				= public_path('themes/front');
				
				//PATH TO APP/VIEWS
				$path_to_views					= app_path().'/views/front';

				$zipper = new \Chumper\Zipper\Zipper;
				
				//UNZIP PUBLIC FOLDER OF THEME
				$zipper->make($file)->folder('public')->extractTo($path_to_assets);
				
				//UNZIP VIEWS FOLDER OF THEME
				$zipper->make($file)->folder('views')->extractTo($path_to_views);

			endif;
			
			//FILENAME OF ZIP FILE IS THEME'S NAME
			$theme_name 						= str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName() );
			

			//GET CURRENT THEME
			$theme_active		= Themes::active()->first();

			//SAVE UPLOADED THEME
			$theme 				= new Themes;
			$theme->theme  		= $theme_name;
			$theme->description = Input::get('description');
			$theme->status      = Input::get('status');
			$theme->save();

			//IF UPLOADED THEME IS SET TO 1, UPDATE CURRENT THEME TO 0
			if ( Input::get('status') == '1' ) :
				
				$theme_active->status = 0;
				$theme_active->save();

			endif;

			return Redirect::to('admin/themes')->with('success', 'You have successfully uploaded a theme.');
		endif;  
	}

	public function getEnable()
	{
		//GET CURRENT THEME
		$theme_active = Themes::active()->first();
		$theme_active->status = 0;
		$theme_active->save(); 

		$theme = Themes::find(Request::segment(4));
		$theme->status = 1;
		$theme->save();

		return Redirect::to('admin/themes')->with('success', 'You have enabled a theme.');
	}


}