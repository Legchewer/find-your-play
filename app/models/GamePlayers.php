<?php

class GamePlayers extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_has_players';

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

    /*
     * The variables that are mass-fillable
     *
     * @var array
     */
    protected $fillable = [
        'game__players_name_nl',
        'game__players_name_en'
    ];

    /**
     * @return array
     */
    public function games()
    {
        return $this->hasMany('Game');
    }
}
