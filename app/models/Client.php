<?php

class Client extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "client_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * @return array
     */
    public function person()
    {
        return $this->belongsTo('Person');
    }

    /**
     * @return array
     */
    public function members()
    {
        return $this->belongsToMany('Member','members_clients', 'client_id', 'member_id');
    }

    /**
     * @return array
     */
    public function games()
    {
        return $this->belongsToMany('Game','clients_has_games', 'client_id', 'game_id')->withPivot('client_game_usedate', 'client_game_evaluation', 'client_game_duration', 'client_game_feedback', 'client_game_shared');
    }

}
