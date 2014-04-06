<?php

class GameFeature extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_features';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_feature_id";

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
        return $this->belongsToMany('Game','games_has_game_features', 'game_feature_id', 'game_id');
    }

}
