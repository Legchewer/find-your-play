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
        'game_title_nl',
        'game_title_en',
        'game_description_nl',
        'game_description_en',
        'game_producer',
        'game_availability',
        'game_price',
        'game_rules_nl',
        'game_rules_en',
        'game_duration_nl',
        'game_duration_en',
        'game_players',
        'game_therapeutic_nl'
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
    public function game_tags()
    {
        return $this->belongsToMany('GameTag','games_has_game_tags', 'game_id', 'game_tag_id');
    }

    /**
     * @return array
     */
    public function game_features()
    {
        return $this->belongsToMany('GameFeature','games_has_game_features', 'game_id', 'game_feature_id');
    }

    /**
     * @return array
     */
    public function game_functions()
    {
        return $this->belongsToMany('GameFunction','games_has_game_functions', 'game_id', 'game_function_id');
    }

    /**
     * @return array
     */
    public function game_type()
    {
        return $this->belongsTo('GameType');
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


}
