<?php

class AgeGroup extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'age_groups';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "age_group_id";

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
        return $this->belongsToMany('Game','games_has_age_groups', 'age_group_id', 'game_id');
    }

}
