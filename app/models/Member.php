<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Member extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "member_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'member_password',
        'member_created',
        'member_modified',
        'member_deleted'
    ];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->member_password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return null;//$this->user_email;
    }

    public static function boot()
    {
        parent::boot();

        /**
         * Hook die aangesproken wordt als het model voor de eerste keer naar de database weggeschreven wordt.
         * Zie: http://laravel.com/docs/eloquent#model-events */

        self::creating(function ($member) {
            $member->member_password = Hash::make($member->member_password);
        });
    }

    /**
     * @return array
     */
    public function role()
    {
        return $this->belongsTo('Role');
    }

    /**
     * @return array
     */
    public function person()
    {
        return $this->belongsTo('Person');
    }

    /**
     * @return array
     */
    public function clients()
    {
        return $this->belongsToMany('Client','members_clients', 'member_id', 'client_id');
    }

}