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
			$categories->category 		= Input::get('category');
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
			'category'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);
		$data['uri'] 			= Request::path();

		if ($validator->fails()) :

			return Redirect::to(Request::path())->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$category 				= Categories::find($id);
			$category->category 	= Input::get('category');
			$category->description 	= Input::get('description');
			$category->status 		= Input::get('status');
			$category->updated_at 	= date('Y-m-d H:i:s');			
			$category->save();

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
		$count 					= Posts::where('id_post', $id)->categories->get();

		var_dump($count); die();
		
		if( $count > 0 ) :
			return Redirect::route('categories.index')->with('error', 'Sorry, there is a post tagged in this category. Delete the post before you can delete the category.');
		else:
			
			$category 				= Categories::find($id);
			$category->delete();

			return Redirect::route('categories.index')->with('success', 'You have successfully deleted a category.');
		endif;
	}


}
