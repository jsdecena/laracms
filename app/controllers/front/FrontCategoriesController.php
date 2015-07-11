<?php

class FrontCategoriesController extends \FrontController {

	public function __construct()
	{
		parent::__construct();
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	public function show($slug)
	{
		//GET THE CATEGORY
		$data['category'] 		= Categories::where('slug', $slug)->first();

		$posts 					= Categories::find($data['category']->id_category)->posts;

		//GET THE POSTS TIED TO THIS CATEGORY
		$blogPosts = array();
		foreach ($posts as $key => $post) {
			
			$blogPosts[$key]['post'] 	= $post;

			//GET THE AUTHOR
			$author 					= User::find($post->id_user);
			$blogPosts[$key]['author'] 	= $author;
		}

		$data['records']		= $this->customPagination($blogPosts, 10);

		$this->layout->content 	= View::make('front.'.$this->theme->theme.'.category', $data);
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


}
