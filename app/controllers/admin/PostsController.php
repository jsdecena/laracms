<?php

class PostsController extends \AdminController {

	public function __construct()
	{
		parent::__construct();

		$this->post_type = "post";
		$this->beforeFilter('permission');
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts 			        = Posts::posts()->orderBy('created_at', 'DESC')->paginate(10);	
		$data['posts']			= $posts;

		//CREATE AN ARRAY OF POSTS WITH THEIR CATEGORIES
		$posts_categories_arr   = array();

		foreach ($posts as $post) :
			$post_arr = array("post" => $post, "categories" => Posts::find($post->id_post)->categories);
			array_push($posts_categories_arr, $post_arr);
		endforeach;

		$data['posts_categories']          = $posts_categories_arr;

		$this->layout->content 	= View::make('admin.posts.list', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['categories']     = Categories::active()->orderBy('created_at', 'DESC' )->get();
		$this->layout->content 	= View::make('admin.posts.add', $data);	
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
			return Redirect::route('posts.create')->withErrors($validator);
		else:
			
			$post 				= new Posts;
			$post->post_type 	= $this->post_type;
			$post->title 		= Input::get('title');
			$post->slug 		= Str::slug(Input::get('title'));
			$post->content 		= Input::get('content');
			$post->status 		= Input::get('status');
			$post->img_src 		= $this->imageUpload('userfile');
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

			return Redirect::route('posts.index')->with('success', 'You have successfully created a post.');

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
		$data['post'] 				 = Posts::find($id);
		$post_categories             = Posts::find($id)->categories;
		
		//ARRAY OF THE CATEGORIES OF THIS POST
		$post_categories_arr 		 = array();
		foreach ($post_categories as $category) :
			array_push($post_categories_arr, $category->id_category);
		endforeach;

		$data['post_categories_arr'] = $post_categories_arr; 		
		$data['categories']          = Categories::active()->orderBy('created_at', 'DESC' )->get();
		
		$this->layout->content 	= View::make('admin.posts.edit', $data);
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
			return Redirect::route('posts.edit', $id)->withErrors($validator)->withInput();
		else:

			$post 				= Posts::find($id);
			$post->title 		= Input::get('title');
			$post->slug 		= Str::slug(Input::get('title'));
			$post->content 		= Input::get('content');
			$post->img_src 		= $this->imageUpload('userfile');
			$post->status 		= Input::get('status');
			$post->updated_at 	= date('Y-m-d H:i:s');			
			
			//SAVE ALSO THE CATEGORY IDS IN THE PIVOT TABLE
			if($post->save())
				$post->categories()->sync(Input::get('categories'));

			return Redirect::route('posts.index')->with('success', 'You have successfully edited a post.');
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
		//DELETE IN POST
		$post = Posts::find($id);
		$post->delete();

		//DELETE IN POST CATEGORIES
		$posts_categories = Posts_Categories::post($id)->delete();

		return Redirect::route('posts.index')->with('success', 'You have successfully deleted a post.');
	}

	public function enable()
	{
		//QUICK ENABLE PAGE
		$post 				= Posts::find(Input::get('id'));
		$post->status 		= 1;
		$post->save();

		return Redirect::route('posts.index')->with('success', 'You have enabled the page.');
	}

	public function disable()
	{
		//QUICK DISABLE PAGE
		$post 				= Posts::find(Input::get('id'));
		$post->status 		= 0;
		$post->save();

		return Redirect::route('posts.index')->with('error', 'You have disabled the page.');
	}

	public function delete_image()
	{
		if (Input::get('action') == "delete_featured_image") {
			
			DB::table('posts')
			            ->where('img_src', Input::get('filename'))
			            ->update(array('img_src' => null));

			return Redirect::route("posts.edit", Input::get('id'))->with('success', 'You have deleted the image.');
		}
	}	
}
