<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
    //protected $guarded = array('secret_key');


    public function getAuthPassword()
    {
        return $this->attributes['secret_key'];
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    /**
     * Check whether the current user is the author of a comment
     *
     * @param Comment $comment
     * @return bool
     */
    public function isAuthor(Comment $comment)
    {
        return $comment->author_id == $this->attributes['id'];
    }

}
