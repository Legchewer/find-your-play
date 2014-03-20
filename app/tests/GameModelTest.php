<?php

class GameModelTest extends TestCase
{

    /**
     * Test voor het model Game
     * @group game
     */
    public function testGameModel()
    {
        $difficulty = GameDifficulty::find(1);
        $budgetgroup = BudgetGroup::find(1);
        $theme = Theme::find(1);
        $therapy = Therapy::find(2);

        $assign1 = [
            'game_title' => 'spel titel',
            'game_producer' => 'producent naam',
            'game_rules' => 'regels',
            'game_duration' => '3-4 uur',
            'game_players' => '1-2 spelers'
        ];

        $game1 = new Game($assign1);

        // assign foreign keys
        $game1->game_difficulty()->associate($difficulty);
        $game1->budget_group()->associate($budgetgroup);
        $game1->theme()->associate($theme);
        $game1->therapy()->associate($therapy);

        $game1->save();

        // attach many to many's
        $game1->game_types()->attach(1);
        $game1->game_types()->attach(2);

        $game1->game_audiences()->attach(1);

        $game1->age_groups()->attach(1);

        $this->assertGreaterThan(0, $game1->game_id);


    }
}