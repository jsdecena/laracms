<?php

class FrontPostController extends \BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['slides'] 		= Carousels::active()->get();

		$posts 					= Posts::posts()->active()->orderBy('created_at', 'desc')->get();

		$blogPosts = array();
		foreach ($posts as $key => $post) {
			
			$blogPosts[$key]['post'] 	= $post;

			//GET THE AUTHOR
			$author 					= User::find($post->id_user);
			$blogPosts[$key]['author'] 	= $author;
		}

		$data['records']		= $blogPosts;

		return Response::json($blogPosts);
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
		//GET THE PAGE
		$data['post'] 					= Posts::posts()->where('slug', $slug)->first();
		$data['post']['categories'] 	= Posts::find($data['post']->id_post)->categories;
		$data['author'] 				= User::find($data['post']->id_user);

		$this->layout->content 	= View::make('front.'.$this->theme->theme.'.post', $data);
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
