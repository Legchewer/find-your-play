<?php

class Theme extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'themes';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "theme_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * @return array
     */
    public function games()
    {
        return $this->hasMany('Game');
    }

}
