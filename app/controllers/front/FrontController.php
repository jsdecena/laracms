<?php

class FrontController extends BaseController {

	public function __construct()
	{
		parent::__construct();

		View::share(array(
				'pages' 			=> Posts::pages()->where('status', 1)->get(),
				'categories'		=> Categories::active()->get(),
				'theme' 			=> $this->theme->theme,
				'shortcut'			=> URL::asset('themes/front/'.$this->theme->theme.'/img/favicon.ico'),
				'favicon'			=> URL::asset('themes/front/'.$this->theme->theme.'/img/favicon.ico'),
			));
		
		$this->layout = 'front.'.$this->theme->theme.'.tpl.main';
	}

	public function search()
	{
		$term = Input::get('term');

		if( Input::has('term') ) :

			$records  					= Posts::whereRaw('match(title, content) against (? in boolean mode)', [$term])->active()->paginate(10);		
			if ( count($records) > 0 ) :
				$data['records']		= $records;
			else :
				$data['error']			= 'No result found.';
			endif;
		
			$this->layout->content 		= View::make('front.'.$this->theme->theme.'.search', $data);
		
		else : 
			
			$data['error'] 				= 'Sorry you have not type any search term. Please try again.';
			$this->layout->content 		= View::make('front.'.$this->theme->theme.'.search', $data);
		
		endif;
	}

	protected function customPagination($data, $perPage, $page = null)
	{
		$page = $page ? (int) $page * 1 : Input::get(Paginator::getPageName(), 1);
		
		$offset = ($page * $perPage) - $perPage;
		
		return Paginator::make(array_slice($data, $offset, $perPage, true), count($data), $perPage);
	}
}
