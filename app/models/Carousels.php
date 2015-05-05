<?php

class Carousels extends Eloquent {

    protected $primaryKey   = 'id_carousel';

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }    
}