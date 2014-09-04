<?php


class Comment extends Eloquent{
    
    protected $guarded = array('id');
    protected $softDelete = false;
    public static $rules = array('comment' => 'required');

    public function author()
    {
        return $this->belongsTo('user', 'author_id');
    }

}

?>
