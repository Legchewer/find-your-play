<?php

class GameFunction extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_functions';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_function_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * @return array
     */
    public function game_function_category()
    {
        return $this->belongsTo('GameFunctionCategory');
    }

    /**
     * @return array
     */
    public function games()
    {
        return $this->belongsToMany('Game','games_has_game_functions', 'game_function_id', 'game_id');
    }

}
