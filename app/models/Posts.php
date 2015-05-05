<?php

class Posts extends Eloquent {

    protected $primaryKey   = 'id_post';
    protected $table = 'posts';
    /* === QUERY SCOPES ===*/
    public function scopePages($query)
    {
        return $query->where('post_type', '=', 'page');
    }
    
    public function scopePosts($query)
    {
        return $query->where('post_type', '=', 'post');
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', '1');
    }

    /* === END QUERY SCOPES ===*/

    /* === RAW QUERIES  ===*/

    public static function view($params)
    {
        $post = DB::table('posts')->where('slug', $params)->first();

        return $post;
    }

    /* === END QUERIES  ===*/

    public function categories(){
        return $this->belongsToMany('Categories', 'posts_categories', 'id_post', 'id_category');
    }
}