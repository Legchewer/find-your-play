<?php

class Role extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "role_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * @return array
     */
    public function member()
    {
        return $this->hasMany('Member');
    }

}
