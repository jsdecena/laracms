<?php

class IndexController extends FrontController {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex()
	{	
		$data['slides'] 		= Carousels::active()->get();
		$data['records']		= Posts::active()->get();
		
		$this->layout->content 	= View::make('front.'.$this->theme->theme.'.index', $data);
	}
}
