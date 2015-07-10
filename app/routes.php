<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*============== ROUTING PATTERNS ============== */
Route::pattern('id_user', '[0-9]+'); //MUST BE NUMERICAL ONLY
Route::pattern('id_page', '[0-9]+'); //MUST BE NUMERICAL ONLY
/*============== END ROUTING PATTERNS ============== */

/*ADMIN FACING ROUTES*/
Route::group(array('before' => 'auth'), function()
{	
	Route::get('users/account', array('as' => 'users.account', 'uses' => 'UsersController@account'));
	Route::post('users/account', array('as' => 'users.account.update', 'uses' => 'UsersController@accountUpdate'));
	Route::get('users/enable', array('as' => 'users.enable', 'uses' => 'UsersController@enable'));
	Route::get('users/disable', array('as' => 'users.disable', 'uses' => 'UsersController@disable'));
	Route::resource('users', 'UsersController');

	Route::get('pages/enable', array('as' => 'pages.enable', 'uses' => 'PagesController@enable'));
	Route::get('pages/disable', array('as' => 'pages.disable', 'uses' => 'PagesController@disable'));
	Route::resource('pages', 'PagesController');

	Route::get('posts/enable', array('as' => 'posts.enable', 'uses' => 'PostsController@enable'));
	Route::get('posts/disable', array('as' => 'posts.disable', 'uses' => 'PostsController@disable'));
	Route::get('posts/featured/image/delete', array('as' => 'posts.featured.image.delete', 'uses' => 'PostsController@delete_image'));
	Route::resource('posts', 'PostsController');

	Route::get('category/posts/{id_category}', array('as' => 'category.posts', 'uses' => 'CategoriesController@posts'));
	Route::get('category/enable', array('as' => 'category.enable', 'uses' => 'CategoriesController@enable'));
	Route::get('category/disable', array('as' => 'category.disable', 'uses' => 'CategoriesController@disable'));
	Route::resource('categories', 'CategoriesController');

	Route::get('carousels/image/delete', array('as' => 'carousel.image.delete', 'uses' => 'CarouselsController@deleteImage'));
	Route::get('carousels/enable', array('as' => 'carousels.enable', 'uses' => 'CarouselsController@enable'));
	Route::get('carousels/disable', array('as' => 'carousels.disable', 'uses' => 'CarouselsController@disable'));	
	Route::resource('carousels', 'CarouselsController');

	Route::resource('roles', 'RolesController');
	Route::resource('settings', 'SettingsController');
	
	Route::controller('admin', 'AdminController');
});

Route::post('password', 						array('as' => 'password.submit', 		'uses' => 'LoginController@passwordSubmit'));
Route::get('password', 							array('as' => 'password.form', 			'uses' => 'LoginController@passwordReset'));

Route::post('password/reset/{token}', 			array('as' => 'password.reset.submit', 	'uses' => 'LoginController@passwordResetSubmit'));
Route::get('password/reset/{token}', 			array('as' => 'password.reset.form', 	'uses' => 'LoginController@passwordResetForm'));

Route::get('logout/submit', 					array('as' => 'logout.submit', 			'uses' => 'LoginController@logout'));
Route::post('login/submit', 					array('as' => 'login.submit', 			'uses' => 'LoginController@login'));

Route::resource('login', 						'LoginController');

Route::resource('cat',		 					'FrontCategoriesController');

Route::get('search', 							array('as' => 'search', 				'uses' => 'FrontController@search'));

Route::resource('post',		 					'FrontPostController');
Route::resource('page',		 					'FrontPageController');
Route::get('/', 								array('as' => 'home', 'uses' => 'IndexController@home'));