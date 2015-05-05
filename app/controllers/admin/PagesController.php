<?php

class PagesController extends AdminController {

	public $post_type;

	public function __construct()
	{
		parent::__construct();

		$this->post_type = "page";
		$this->beforeFilter('permission');
	}

	public function getIndex()
	{
		return $this->getList();
	}

	public function getList()
	{
		//CURRENT LOGGED USER
		$data['logged']			= User::find( Auth::id() );
		//QUERY ALL THE PAGES
		$data['pages'] 			= Posts::pages()->orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));

		$this->layout->content 	= View::make('admin.pages.list', $data);
	}

	public function getAdd()
	{
		$data['uri'] 			= Request::path();
		$this->layout->content 	= View::make('admin.pages.add', $data);	
	}

	public function postAdd()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'title'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator);
		else:
			
			$page 				= new Posts;
			
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
					$page->img_src 		= $newImage;
				endif;
			endif;

			$page->post_type 	= $this->post_type;
			$page->title 		= Input::get('title');
			$page->slug 		= Str::slug(Input::get('title'));
			$page->content 		= Input::get('content');
			$page->status 		= Input::get('status');
			$page->created_at 	= date('Y-m-d H:i:s');
			$page->updated_at 	= date('Y-m-d H:i:s');
			$page->save();

			return Redirect::to('admin/pages')->with('success', 'You have successfully edited a page.');
		endif;
	}	

	public function getEdit()
	{
		$data['page'] 			= Posts::find(Request::segment(4));
		$data['uri'] 			= Request::path();
		$this->layout->content 	= View::make('admin.pages.edit', $data);
	}

	public function postEdit()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'title'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$page 				= Posts::find(Request::segment(4));
			
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
					$page->img_src 		= $newImage;
				endif;
			endif;

			$page->title 		= Input::get('title');
			$page->slug 		= Str::slug(Input::get('title'));
			$page->content 		= Input::get('content');
			$page->status 		= Input::get('status');
			$page->created_at 	= date('Y-m-d H:i:s');
			$page->updated_at 	= date('Y-m-d H:i:s');			
			$page->save();

			return Redirect::to('admin/pages')->with('success', 'You have successfully edited a page.');
		endif;		
	}

	public function getDelete()
	{
		$page = Posts::find(Request::segment(4));
		$page->delete();

		return Redirect::to('admin/pages')->with('success', 'You have successfully deleted a page.');
	}	

	public function getEnable()
	{
		//QUICK ENABLE PAGE
		$page 				= Posts::find(Request::segment(4));
		$page->status 		= 1;
		$page->save();

		return Redirect::to('admin/pages')->with('success', 'You have enabled the page.');
	}

	public function getDisable()
	{
		//QUICK DISABLE PAGE
		$page 				= Posts::find(Request::segment(4));
		$page->status 		= 0;
		$page->save();

		return Redirect::to('admin/pages')->with('error', 'You have disabled the page.');
	}	
}