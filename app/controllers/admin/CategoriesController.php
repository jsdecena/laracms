<?php

class CategoriesController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['categories'] 			= Categories::orderBy($this->settingsValue('ORDER_BY'), $this->settingsValue('ARRANGE_BY'))->paginate((int)$this->settingsValue('POSTS_PER_PAGE'));
		$this->layout->content 			= View::make('admin.categories.list', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content 	= View::make('admin.categories.add');
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
			'category'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::to(Request::path())->withErrors($validator);
		else:
			
			$categories 				= new Categories;
			$categories->name 			= Input::get('category');
			$categories->slug 			= Str::slug(Input::get('category'));
			$categories->description 	= Input::get('description');
			$categories->status 		= Input::get('status');
			$categories->created_at 	= date('Y-m-d H:i:s');
			$categories->updated_at 	= date('Y-m-d H:i:s');
			$categories->save();

			return Redirect::route('categories.index')->with('success', 'You have successfully added a category.');
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
		$data['category'] 			= Categories::find($id);
		$this->layout->content 		= View::make('admin.categories.edit', $data);
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
			'name'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::route('categories.edit', $id)->withErrors($validator)->withInput();
		else:
			
			$categories 				= Categories::find($id);
			$categories->name 			= Input::get('name');
			$categories->slug 			= Str::slug(Input::get('name'));
			$categories->description 	= Input::get('description');
			$categories->status 		= Input::get('status');
			$categories->updated_at 	= date('Y-m-d H:i:s');			
			$categories->save();

			return Redirect::route('categories.index')->with('success', 'You have successfully edited a category.');
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
		/*CHECK IF THERE IS A POST ATTACHED TO THIS CATEGORY*/
		if(Categories::find($id)->posts()->count()) :
			return Redirect::route('categories.index')->with('error', 'Sorry, there is a post tagged in this category. Delete the post before you can delete the category.');
		else:
			$category 				= Categories::find($id);
			$category->delete();

			return Redirect::route('categories.index')->with('success', 'You have successfully deleted a category.');
		endif;
	}

	public function enable()
	{
		//QUICK ENABLE PAGE
		$category 				= Categories::find(Input::get('id'));
		$category->status 		= 1;
		$category->save();

		return Redirect::route('categories.index')->with('success', 'You have enabled the page.');
	}

	public function disable()
	{
		//QUICK DISABLE PAGE
		$category 				= Categories::find(Input::get('id'));
		$category->status 		= 0;
		$category->save();

		return Redirect::route('categories.index')->with('error', 'You have disabled the page.');
	}

	public function posts($id_category)
	{
		$data['posts'] 				= Categories::find($id_category)->posts()->paginate(10);

		$this->layout->content 		= View::make('admin.categories.posts', $data);
	}
}