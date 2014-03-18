<?php

class BudgetGroup extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'budget_groups';

    /**
     * The primary key id.
     *
     * @var string
     */
    protected $primaryKey = "budget_group_id";

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
        return $this->hasMany('Game');
    }

}
