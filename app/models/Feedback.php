<?php

class Feedback extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedback';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "feedback_id";

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
        return $this->belongsTo('Member');
    }

    /**
     * @return array
     */
    public function game()
    {
        return $this->belongsTo('Game');
    }

}
