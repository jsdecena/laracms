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

Route::post('admin/settings', 'SettingsController@postSettings');

/*ADMIN FACING ROUTES*/
Route::group(array('before' => 'auth'), function()
{
	/*ADMIN ROUTES HERE*/
	Route::controller('admin/users/roles', 'RolesController');
	Route::controller('admin/users', 'UsersController');
	Route::controller('admin/pages', 'PagesController');
	Route::controller('admin/posts', 'PostsController');
	Route::controller('admin/categories', 'CategoriesController');
	Route::controller('admin/settings', 'SettingsController');
	Route::controller('admin/themes', 'ThemesController');
	Route::controller('admin/modules/carousels', 'CarouselsController');
	Route::controller('admin', 'AdminController');
});

/*PUBLIC FACING ROUTES*/
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@submit');

/*@param $category - Name of the category*/
Route::get('categories/{category}', 'FrontController@category');
Route::get('search', 'FrontController@search');

Route::get('/{slug}', 'FrontController@viewSlug');
Route::controller('/', 'IndexController');