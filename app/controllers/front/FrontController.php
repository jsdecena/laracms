<?php

class FrontController extends BaseController {

	public function __construct()
	{
		parent::__construct();

		View::share(array(
				'pages' 			=> Posts::pages()->orderBy('created_at', 'DESC')->get()
			));
		
		$this->layout = 'front.'.$this->theme->theme.'.tpl.main';
	}

	public function viewSlug()
	{
		$theme						= Themes::active()->first();
		/*RETURN THE PAGE BEING VIEWED*/
		$data['record']				= Posts::view(Request::segment(1));
		$this->layout->content 		= View::make('front.'.$this->theme->theme.'.page', $data);
	}

	public function category()
	{
		$theme					= Themes::active()->first();
		$data['category']		= Categories::find(Request::segment(2));
		$data['posts'] 			= DB::table('posts')
									        ->join('categories', function($join)
									        {
									            $join->on('categories.id_category', '=', 'posts.post_cat')
									                 ->where('posts.post_cat', '=', Request::segment(2))
									                 ->where('posts.status', '=', 1);
									        })
									        ->paginate(10);

		$this->layout->content 		= View::make('front.'.$this->theme->theme.'.category', $data);
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
}
