<?php

class GameType extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_types';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_type_id";

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
        return $this->belongsToMany('Game','games_has_game_types', 'game_type_id', 'game_id');
    }

}
