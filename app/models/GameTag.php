<?php

class GameTag extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_tags';

    /**
     * The primary key id.
     *
     * @var int
     */
    protected $primaryKey = "game_tag_id";

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
        return $this->belongsToMany('Game','games_has_game_tags', 'game_tag_id', 'game_id');
    }

}
