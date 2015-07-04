<?php

class Categories extends Eloquent {

	protected $guarded 		= array('id_category', 'created_at', 'updated_at');
	protected $table 		= 'categories';
	protected $primaryKey   = 'id_category';
	
	public function scopeActive($query)
	{
		return $query->where('status', '=', '1');
	}

    public function posts()
    {
        return $this->belongsToMany('Posts', 'posts_categories', 'id_category', 'id_post');
    }
	
}