<?php

class Permissions extends Eloquent {

	protected $guarded 		= array('id_permnission', 'created_at', 'updated_at');
	protected $table 		= 'permissions';
	protected $primaryKey   = 'id_permission';


	public function scopeExceptNone($query){
		return $query->where('id_permission', '!=', 5);
	}

	public function users()
    {
        return $this->belongsToMany('User', 'roles_permission', 'id_permission', 'id_role');
    }
}