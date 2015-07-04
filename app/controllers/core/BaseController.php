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

	public function imageUpload($filename)
	{
		if (Input::hasFile($filename)):

			$path = public_path('uploads');
			$file = Input::file($filename);

			$newImage = value(function() use ($file){
			    $filename = str_random(10) . '.' . $file->getClientOriginalExtension();
			    return strtolower($filename);
			});

			if($upload = $file->move($path, $newImage))
				return $newImage;
		endif;		
	}	

}