<?php

class Users_Permissions extends Eloquent
{
	protected $primaryKey = 'id_user_permission';
	protected $guarded = array('id_user_permission', 'created_at', 'updated_at');
	protected $table = 'users_permissions';
	
}