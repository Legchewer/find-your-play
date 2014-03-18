<?php

class Person extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "person_id";

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
        return $this->hasOne('Member');
    }

    /**
     * @return array
     */
    public function client()
    {
        return $this->hasOne('Client');
    }

}
