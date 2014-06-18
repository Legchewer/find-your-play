<?php

class GamePlayers extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_players';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_players_id";

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
