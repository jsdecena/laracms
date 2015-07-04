<?php

class CarouselsController extends \AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['carousels'] 		= Carousels::orderBy('created_at', 'DESC')->paginate(10);
		
		/*CAROUSEL SETTINGS*/
		$this->layout->content 	= View::make('admin.modules.carousel.list', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content 	= View::make('admin.modules.carousel.add');
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
			return Redirect::route('carousels.create')->withErrors($validator);
		else:
			
			$carousel 				= new Carousels;
			$carousel->title 		= Input::get('title');
			$carousel->description 	= Input::get('description');
			$carousel->link 		= Input::get('link');
			$carousel->status 		= Input::get('status');
			$carousel->img_src 		= $this->imageUpload('userfile');
			$carousel->created_at 	= date('Y-m-d H:i:s');
			$carousel->updated_at 	= date('Y-m-d H:i:s');
			$carousel->save();

			return Redirect::route('carousels.index')->with('success', 'You have successfully added a slide.');
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
		$data['slide'] 			= Carousels::find($id);
		$this->layout->content 	= View::make('admin.modules.carousel.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'title'			=> 'required'
		);

		$validator 				= Validator::make(Input::all(), $rules);

		if ($validator->fails()) :
			return Redirect::route('carousels.edit', $id)->withErrors($validator)->withInput(Input::except('password'));
		else:
			
			$slide 				= Carousels::find($id);
			$slide->title 		= Input::get('title');
			$slide->description = Input::get('description');
			$slide->link 		= Input::get('link');
			$slide->img_src 	= $this->imageUpload('userfile');
			$slide->status 		= Input::get('status');
			$slide->created_at 	= date('Y-m-d H:i:s');
			$slide->updated_at 	= date('Y-m-d H:i:s');
			$slide->save();

			return Redirect::route('carousels.index')->with('success', 'You have successfully edited a page.');
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
		$slide = Carousels::find($id);
		$slide->delete();

		return Redirect::route('carousels.index')->with('success', 'You have successfully deleted a slide.');
	}

	public function deleteImage()
	{
		if (Input::get('action') == "delete_image") {
			
			DB::table('carousels')
			            ->where('img_src', Input::get('filename'))
			            ->update(array('img_src' => null));

			return Redirect::route("carousels.edit", Input::get('id'))->with('success', 'You have deleted the image.');
		}
	}

	public function enable()
	{
		//QUICK ENABLE PAGE
		$carousel 				= Carousels::find(Input::get('id'));
		$carousel->status 		= 1;
		$carousel->save();

		return Redirect::route('carousels.index')->with('success', 'You have enabled the slide.');
	}

	public function disable()
	{
		//QUICK DISABLE PAGE
		$carousel 				= Carousels::find(Input::get('id'));
		$carousel->status 		= 0;
		$carousel->save();

		return Redirect::route('carousels.index')->with('error', 'You have disabled the slide.');
	}	
}
