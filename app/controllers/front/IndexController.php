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
			$blogPosts[$key]['title'] 		= $post->title;
			$blogPosts[$key]['content'] 	= $post->content;
			$blogPosts[$key]['slug'] 		= $post->slug;
			$blogPosts[$key]['created_at'] 	= $post->created_at;

			//GET THE AUTHOR
			$author 					= User::find($post->id_user);
			$blogPosts[$key]['author'] 	= $author;

		}

		$data['records']		= $blogPosts;
		
		$this->layout->content 	= View::make('front.'.$this->theme->theme.'.index', $data);
	}
}
