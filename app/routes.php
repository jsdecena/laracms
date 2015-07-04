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

/*LOGIN CONTROLLER MUST BE FIRST BEFORE THE AUTH*/
Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@submit');
Route::get('logout', 'LoginController@logout');

Route::get('password', 'LoginController@password');
Route::post('password', 'LoginController@passwordSubmit');
Route::get('password/reset/{token}', 'LoginController@password_reset');
Route::post('password/reset/{token}', 'LoginController@password_reset_submit');

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

Route::get('{slug}', 'FrontController@viewSlug');
Route::get('/', 'IndexController@home');

/*PUBLIC FACING ROUTES*/
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@submit');

/*@param $category - Name of the category*/
Route::get('categories/{category}', 'FrontController@category');
Route::get('search', 'FrontController@search');