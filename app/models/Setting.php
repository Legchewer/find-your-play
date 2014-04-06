<?php

class Setting extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "setting_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

}
