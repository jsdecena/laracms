<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $primaryKey = 'id_user';
	protected $fillable 	= array('email');
	protected $guarded 		= array('img_src', 'password');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function role(){
		return $this->belongsTo('Roles', 'id_role', 'id_role');
	}

	public function permissions(){
		return $this->belongsToMany('Permissions', 'users_permissions', 'id_user', 'id_permission');
	}

	public function can($permission){

		return in_array($permission, array_fetch( $this->permissions->toArray(), 'permission') );
	}

}
