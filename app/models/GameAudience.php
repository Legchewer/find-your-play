<?php

class GameAudience extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_audiences';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_audience_id";

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
        return $this->belongsToMany('Game','games_has_game_audiences', 'game_audience_id', 'game_id');
    }

}
