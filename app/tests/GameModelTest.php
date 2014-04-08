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
        $type = GameType::find(1);

        $assign1 = [
            'game_title_nl' => 'Nijntje vormenstoof',
            'game_title_en' => 'Nijntje shape puzzle',
            'game_description_nl' => 'Een vormenstoof van Nijntje',
            'game_description_en' => 'A shape puzzle from Nijntje',
            'game_producer' => 'Ravensburger',
            'game_availability' => 'www.ravensburger.com',
            'game_age_nl' => 'vanaf 3 jaar',
            'game_age_en' => 'age 3 and up',
            'game_price' => '15 EUR',
            'game_rules_nl' => 'de regels',
            'game_rules_en' => 'the rules',
            'game_duration_nl' => '3-4 uur',
            'game_duration_en' => '3-4 hour',
            'game_players' => '1-2',
            'game_therapeutic_nl' => 'therapeutische fiche'
        ];

        $game1 = new Game($assign1);

        // assign foreign keys
        $game1->game_difficulty()->associate($difficulty);
        $game1->budget_group()->associate($budgetgroup);
        $game1->theme()->associate($theme);
        $game1->game_type()->associate($type);

        $game1->save();

        // attach many to many's
        $game1->game_features()->attach(1);
        $game1->game_features()->attach(2);
        $game1->game_features()->attach(3);

        $game1->game_functions()->attach(1);
        $game1->game_functions()->attach(2);

        $game1->game_tags()->attach(1);
        $game1->game_tags()->attach(2);
        $game1->game_tags()->attach(3);
        $game1->game_tags()->attach(4);

        $this->assertGreaterThan(0, $game1->game_id);


    }
}