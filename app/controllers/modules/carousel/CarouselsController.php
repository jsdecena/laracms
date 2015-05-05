<?php

class CarouselsController extends AdminController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex()
	{
		$this->getList();
		
	}

	public function getList()
	{
		$data['carousels'] 		= Carousels::orderBy('created_at', 'DESC')->paginate(10);
		
		/*CAROUSEL SETTINGS*/
		$this->layout->content 	= View::make('admin.modules.carousel.list', $data);
	}	

	public function getAdd()
	{
		/*CAROUSEL SETTINGS*/
		$this->layout->content 	= View::make('admin.modules.carousel.add');
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
			
			$carousel 				= new Carousels;
			
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
					$carousel->img_src 		= $newImage;
				endif;
			endif;

			$carousel->title 		= Input::get('title');
			$carousel->description 	= Input::get('description');
			$carousel->link 		= Input::get('link');
			$carousel->status 		= Input::get('status');
			$carousel->created_at 	= date('Y-m-d H:i:s');
			$carousel->updated_at 	= date('Y-m-d H:i:s');
			$carousel->save();

			return Redirect::to('admin/modules/carousels/list')->with('success', 'You have successfully added a slide.');
		endif;
	}

	public function getEdit()
	{
		$data['slide'] 			= Carousels::find(Request::segment(5));
		$this->layout->content 	= View::make('admin.modules.carousel.edit', $data);
	}

	public function postEdit()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'title'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::to(Request::path())->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$slide 				= Carousels::find(Request::segment(5));
			
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
					$slide->img_src 		= $newImage;
				endif;
			endif;

			$slide->title 		= Input::get('title');
			$slide->description = Input::get('description');
			$slide->link 		= Input::get('link');
			$slide->status 		= Input::get('status');
			$slide->created_at 	= date('Y-m-d H:i:s');
			$slide->updated_at 	= date('Y-m-d H:i:s');
			$slide->save();

			return Redirect::to('admin/modules/carousels/list')->with('success', 'You have successfully edited a page.');
		endif;		
	}

	public function getDelete()
	{
		$slide = Carousels::find(Request::segment(5));
		$slide->delete();

		return Redirect::to('admin/modules/carousels/list')->with('success', 'You have successfully deleted a slide.');
	}

	public function getEnable()
	{
		//QUICK ENABLE PAGE
		$slide 				= Carousels::find(Request::segment(5));
		$slide->status 		= 1;
		$slide->save();

		return Redirect::to('admin/modules/carousels/list')->with('success', 'You have enabled the slide.');
	}

	public function getDisable()
	{
		//QUICK DISABLE PAGE
		$slide 				= Carousels::find(Request::segment(5));
		$slide->status 		= 0;
		$slide->save();

		return Redirect::to('admin/modules/carousels/list')->with('error', 'You have disabled the slide.');
	}	
}