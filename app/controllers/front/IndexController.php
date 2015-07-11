<?php

class IndexController extends FrontController {

	public function __construct()
	{
		parent::__construct();
	}

	public function home()
	{
		$data['slides'] 		= Carousels::active()->get();

		$posts 					= Posts::posts()->get();

		$blogPosts = array();
		foreach ($posts as $key => $post) {
			
			$blogPosts[$key]['post'] 	= $post;

			//GET THE AUTHOR
			$author 					= User::find($post->id_user);
			$blogPosts[$key]['author'] 	= $author;
		}

		$data['records']		= $this->customPagination($blogPosts, 10);
		
		$this->layout->content 	= View::make('front.'.$this->theme->theme.'.index', $data);
	}
}
