<?php

class PostsController extends AdminController {

	public $post_type;

	public function __construct()
	{
		parent::__construct();

		$this->post_type = "post";
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
		//QUERY ALL THE USERS
		$posts 			        = Posts::posts()->orderBy('created_at', 'DESC')->paginate(10);
		
		$data['posts']			= $posts;

		//Create AN ARRAY OF POSTS WITH THEIR CATEGORIES
		$posts_categories_arr   = array();

		foreach ($posts as $post) :
			$post_arr = array("post" => $post, "categories" => Posts::find($post->id_post)->categories);
			array_push($posts_categories_arr, $post_arr);
		endforeach;

		$data['posts_categories']          = $posts_categories_arr;

		$this->layout->content 	= View::make('admin.posts.list', $data);
	}

	public function getAdd()
	{
		$data['uri'] 			= Request::path();
		$data['categories']     = Categories::active()->orderBy('created_at', 'DESC' )->get();
		// dd($data['categories'][0]);
		$this->layout->content 	= View::make('admin.posts.add', $data);	
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
			
			$post 				= new Posts;
			
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
					$post->img_src 		= $newImage;
				endif;
			endif;

			$post->post_type 	= $this->post_type;
			$post->title 		= Input::get('title');
			$post->slug 		= Str::slug(Input::get('title'));
			$post->content 		= Input::get('content');
			$post->status 		= Input::get('status');
			$post->created_at 	= date('Y-m-d H:i:s');
			$post->updated_at 	= date('Y-m-d H:i:s');
			$post->save();

			
			//GET THE ID OF LAST INSERTED POST
			$id_post = $post->id_post;

			$categories 		= Input::get('categories'); 
			
			
			if( is_array($categories) ) :
				// LOOP FOR CATEGORIES 
			 	for ( $i = 0;  $i < count($categories); $i++ ) :
			 		
			 		$data 		= array(
			 			
			 			'id_post' 		=> $id_post,
			 			'id_category'	=> $categories[$i],
			 			'created_at'    => date('Y-m-d H:i:s'),
			 			'updated_at'    => date('Y-m-d H:i:s')
			 		
			 		);

			 		$posts_categories = Posts_Categories::create($data);

			 	endfor;
			 
			else :
			 	
			 	$data           = array(

			 			'id_post'       => $id_post,
			 			'id_category'   => 1,
			 			'created_at'    => date('Y-m-d H:i:s'),
			 			'updated_at'    => date('Y-m-d H:i:s')
			 		);

			 	$posts_categories = Posts_Categories::create($data);

			endif; 

			 //INSERT TO POST CATEGORIES

			
			return Redirect::to('admin/posts')->with('success', 'You have successfully edited a post.');
		endif;
	}	

	public function getEdit()
	{
		$data['post'] 				 = Posts::find(Request::segment(4));
		$data['uri'] 				 = Request::path();
		$post_categories             = Posts::find( Request::segment(4) )->categories;
		
		//ARRAY OF THE CATEGORIES OF THIS POST
		$post_categories_arr 		 = array();

		foreach ($post_categories as $category) :
			array_push($post_categories_arr, $category->id_category);
		endforeach;

		$data['post_categories_arr'] = $post_categories_arr; 		
		$data['categories']          = Categories::active()->orderBy('created_at', 'DESC' )->get();
		
		$this->layout->content 	= View::make('admin.posts.edit', $data);
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
			if (Input::has('ajax')):
				$this->ajaxPostProcess( Posts::find(Request::segment(4)) );
				return Response::json( array(
		            'result' => true
		        ) );
			else:
				return Redirect::to(Request::path())->withErrors($validator)->withInput();
			endif;
		else:
			$post 	= Posts::find(Request::segment(4));
			
			//AJAX DELETE FEATURED IMAGE

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
					$post->img_src 		= $newImage;
				endif;
			endif;

			$post->title 		= Input::get('title');
			$post->slug 		= Str::slug(Input::get('title'));
			$post->content 		= Input::get('content');
			$post->status 		= Input::get('status');
			$post->updated_at 	= date('Y-m-d H:i:s');			
			$post->save();

			$posts_categories   = Posts_Categories::where('id_post', '=', Request::segment(4))->delete();

			//GET THE ID OF LAST INSERTED POST
			$categories 		= Input::get('categories'); 
			
			if( is_array($categories) ) :
				// LOOP FOR CATEGORIES 
			 	for ( $i = 0;  $i < count($categories); $i++ ) :
			 		
			 		$data 		= array(
			 			
			 			'id_post' 		=> Request::segment(4),
			 			'id_category'	=> $categories[$i],
			 			'created_at'    => date('Y-m-d H:i:s'),
			 			'updated_at'    => date('Y-m-d H:i:s')
			 		
			 		);

			 		$posts_categories = Posts_Categories::create($data);

			 	endfor;
			 
			else :
			 	
			 	$data           = array(

			 			'id_post'       => Request::segment(4),
			 			'id_category'   => 1,
			 			'created_at'    => date('Y-m-d H:i:s'),
			 			'updated_at'    => date('Y-m-d H:i:s')
			 		);

			 	$posts_categories = Posts_Categories::create($data);

			endif; 
  

			return Redirect::to('admin/posts')->with('success', 'You have successfully edited a post.');
		endif;		
	}

	public function getDelete()
	{
		//DELETE IN POST
		$post = Posts::find(Request::segment(4));
		$post->delete();

		//DELETE IN POST CATEGORIES
		$posts_categories = Posts_Categories::post( Request::segment(4) )->delete();

		return Redirect::to('admin/posts')->with('success', 'You have successfully deleted a post.');
	}	

	public function getEnable()
	{
		//QUICK ENABLE post
		$post 				= Posts::find(Request::segment(4));
		$post->status 		= 1;
		$post->save();

		return Redirect::to('admin/posts')->with('success', 'You have enabled the post.');
	}

	public function getDisable()
	{
		//QUICK DISABLE post
		$post 				= Posts::find(Request::segment(4));
		$post->status 		= 0;
		$post->save();

		return Redirect::to('admin/posts')->with('error', 'You have disabled the post.');
	}

	/*
	* @author: Albert Fajarito
	* @param: post | ORM object
	*/
	protected function ajaxPostProcess( $post )
	{

		$action 	= Input::get('action');		
		$subject	= Input::get('subject');

		if( strtoupper($action) == "REMOVE")
		{
			switch ( strtoupper($subject) )
			{
				case "FEATUREDIMG":
					$post->img_src = "";
					break;
			}			
		}

		$post->save();	
	}
}