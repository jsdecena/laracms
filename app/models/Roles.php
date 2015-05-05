<?php

class Roles extends Eloquent {

	protected $primaryKey   = 'id_role';
	protected $table = 'roles';
	protected $guarded = array('id_role', 'created_at', 'updated_at');

	public function scopeOfIdRole($query, $id_role)
	{
		return $query->whereIdRole($id_role);
	}

	public function scopeActive($query)
	{	
		return $query->where('status', '=', '1');
	}

	public function permissions(){
		return $this->belongsToMany('Permissions', 'roles_permissions', 'id_role', 'id_permission');
	}

	public function users(){
		return $this->hasMany('User', 'id_role', 'id_role');
	}

	
}