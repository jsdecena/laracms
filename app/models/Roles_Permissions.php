<?php

class Roles_Permissions extends Eloquent
{
	protected $primaryKey = 'id_role_permission';
	protected $guarded = array('id_role_permission', 'created_at', 'updated_at');
	protected $table = 'roles_permissions';
	
}