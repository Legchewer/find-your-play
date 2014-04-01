<?php

class Game extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_id";

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
        'game_title',
        'game_producer',
        'game_rules',
        'game_duration',
        'game_players'
    ];

    /**
     * @return array
     */
    public function clients()
    {
        return $this->belongsToMany('Client','clients_has_games', 'game_id', 'client_id')->withPivot('client_game_usedate', 'client_game_evaluation', 'client_game_duration', 'client_game_feedback', 'client_game_shared');
    }

    /**
     * @return array
     */
    public function game_types()
    {
        return $this->belongsToMany('GameType','games_has_game_types', 'game_id', 'game_type_id');
    }

    /**
     * @return array
     */
    public function age_groups()
    {
        return $this->belongsToMany('AgeGroup','games_has_age_groups', 'game_id', 'age_group_id');
    }

    /**
     * @return array
     */
    public function game_difficulty()
    {
        return $this->belongsTo('GameDifficulty');
    }

    /**
     * @return array
     */
    public function budget_group()
    {
        return $this->belongsTo('BudgetGroup');
    }

    /**
     * @return array
     */
    public function theme()
    {
        return $this->belongsTo('Theme');
    }

    /**
     * @return array
     */
    public function therapy()
    {
        return $this->belongsTo('Therapy');
    }


}
