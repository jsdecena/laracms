<?php

class Posts_Categories extends Eloquent
{
	protected $primaryKey = 'id_post_category';
	protected $guarded = array('id_post_category', 'created_at', 'updated_at');
	protected $table = 'posts_categories';
	
	public function scopePost($query, $id_post){
		return $query->where('id_post', '=', $id_post);
	}
}