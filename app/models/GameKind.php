<?php

class GameKind extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_kinds';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_kind_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * @return array
     */
    public function game_types()
    {
        return $this->hasMany('GameType');
    }

}
