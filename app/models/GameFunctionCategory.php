<?php

class GameFunctionCategory extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_function_categories';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "game_function_category_id";

    /**
     * Disable timestamps.
     *
     */
    public $timestamps = false;

    /**
     * @return array
     */
    public function gameFunctions()
    {
        return $this->hasMany('GameFunction');
    }

}
