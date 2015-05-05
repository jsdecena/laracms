<?php

class Themes extends Eloquent {

	protected $guarded 		= array('id_theme', 'created_at', 'updated_at');
	protected $table 		= 'themes';
	protected $primaryKey   = 'id_theme';
	
	public function scopeActive($query)
	{
		return $query->where('status', '=', '1');
	}

	
}