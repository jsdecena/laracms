<?php

class BaseController extends Controller {
	
	protected $layout;

	protected $theme;
	
	public function __construct()
	{
		$this->theme = Themes::active()->first();
	}
	
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}