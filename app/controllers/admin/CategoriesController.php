<?php

class CategoriesController extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('permission');
	}

	public function getIndex()
	{
		$this->getList();
	}

	public function getList()
	{
		//CURRENT LOGGED USER
		$data['logged']					=  User::find( Auth::id() );

		$data['categories'] 			= Categories::orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));
		$this->layout->content 			= View::make('admin.categories.list', $data);
	}

	public function getAdd()
	{
		$this->layout->content 	= View::make('admin.categories.add');	
	}

	public function postAdd()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'category'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::to(Request::path())->withErrors($validator);
		else:
			
			$categories 				= new Categories;
			$categories->category 		= Input::get('category');
			$categories->description 	= Input::get('description');
			$categories->status 		= Input::get('status');
			$categories->created_at 	= date('Y-m-d H:i:s');
			$categories->updated_at 	= date('Y-m-d H:i:s');
			$categories->save();

			return Redirect::to('admin/categories')->with('success', 'You have successfully added a category.');
		endif;
	}

	public function getEdit()
	{
		$data['category'] 			= Categories::find(Request::segment(4));
		$this->layout->content 		= View::make('admin.categories.edit', $data);
	}

	public function postEdit()
	{
	    //VALIDATE THE INPUTS SUBMITTED
		$rules = array(
			'category'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$category 				= Categories::find(Request::segment(4));
			$category->category 	= Input::get('category');
			$category->description 	= Input::get('description');
			$category->status 		= Input::get('status');
			$category->updated_at 	= date('Y-m-d H:i:s');			
			$category->save();

			return Redirect::to('admin/categories/list')->with('success', 'You have successfully edited a page.');
		endif;		
	}

	public function getDelete()
	{
		/*CHECK IF THERE IS A POST ATTACHED TO THIS CATEGORY*/
		$count 					= Posts::where('post_cat', '=', Request::segment(4))->count();
		
		if( $count > 0 ) :
			return Redirect::to('admin/categories/list')->with('error', 'Sorry, there is a post tagged in this category. Delete the post before you can delete the category.');
		else:
			
			$category 				= Categories::find(Request::segment(4));
			$category->delete();

			return Redirect::to('admin/categories/list')->with('success', 'You have successfully deleted a category.');
		endif;

	}	

	public function getEnable()
	{
		//QUICK ENABLE PAGE
		$category 				= Categories::find(Request::segment(4));
		$category->status 		= 1;
		$category->save();

		return Redirect::to('admin/categories/list')->with('success', 'You have enabled the category.');
	}

	public function getDisable()
	{
		//QUICK DISABLE PAGE
		$category 				= Categories::find(Request::segment(4));
		$category->status 		= 0;
		$category->save();

		return Redirect::to('admin/categories/list')->with('error', 'You have disabled the category.');
	}	
}