<?php

class PagesController extends \AdminController {

	public function __construct()
	{
		parent::__construct();

		$this->post_type = "page";
		$this->beforeFilter('permission');
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//QUERY ALL THE PAGES
		$data['pages'] 			= Posts::pages()->orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));

		$this->layout->content 	= View::make('admin.pages.list', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content 	= View::make('admin.pages.add');
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
			'title'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::route('pages.create')->withErrors($validator);
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

			return Redirect::route('pages.index')->with('success', 'You have successfully added a page.');
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
		$data['page'] 			= Posts::find($id);
		$this->layout->content 	= View::make('admin.pages.edit', $data);
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
			'title'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :

			return Redirect::route('pages.edit', $id)->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$page 				= Posts::find($id);
			
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

			return Redirect::route('pages.index')->with('success', 'You have successfully edited a page.');
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
		$page = Posts::find($id);
		$page->delete();

		return Redirect::route('pages.index')->with('success', 'You have successfully deleted a page.');
	}

	public function enable()
	{
		//QUICK ENABLE PAGE
		$page 				= Posts::find(Input::get('id'));
		$page->status 		= 1;
		$page->save();

		return Redirect::route('pages.index')->with('success', 'You have enabled the page.');
	}

	public function disable()
	{
		//QUICK DISABLE PAGE
		$page 				= Posts::find(Input::get('id'));
		$page->status 		= 0;
		$page->save();

		return Redirect::route('pages.index')->with('error', 'You have disabled the page.');
	}
}
