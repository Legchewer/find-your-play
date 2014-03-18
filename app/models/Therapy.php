<?php

class Therapy extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'therapies';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "therapy_id";

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

    /**
     * @return array
     */
    public function parent_therapy()
    {
        return $this->belongsTo('Therapy','parent_therapy_id');
    }

}
