<?php

class GameDifficultyModelTest extends TestCase
{

    /**
     * Test voor het model GameDifficulty
     * @group gamedifficulty
     */
    public function testGameDifficultyModel()
    {

        $difficulty1 = new GameDifficulty();
        $difficulty1->game_difficulty_name_nl = "Gemakkelijk";
        $difficulty1->game_difficulty_name_en = "Easy";

        $difficulty2 = new GameDifficulty();
        $difficulty2->game_difficulty_name_nl = "Gemiddeld";
        $difficulty2->game_difficulty_name_en = "Medium";

        $difficulty3 = new GameDifficulty();
        $difficulty3->game_difficulty_name_nl = "Moeilijk";
        $difficulty3->game_difficulty_name_en = "Hard";

        $difficulty1->save();
        $difficulty2->save();
        $difficulty3->save();

        $this->assertGreaterThan(0, $difficulty1->game_difficulty_id);
        $this->assertGreaterThan(0, $difficulty2->game_difficulty_id);
        $this->assertGreaterThan(0, $difficulty3->game_difficulty_id);

    }
}