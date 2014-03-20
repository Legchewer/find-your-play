<?php

class GameAudienceModelTest extends TestCase
{

    /**
     * Test voor het model GameAudience
     * @group gameaudience
     */
    public function testGameAudienceModel()
    {

        $audience1 = new GameAudience();
        $audience1->game_audience_name_nl = 'ADHD';
        $audience1->game_audience_name_en = 'ADD';

        $audience1->save();

        $audience2 = new GameAudience();
        $audience2->game_audience_name_nl = 'Autisme';
        $audience2->game_audience_name_en = 'Autism';

        $audience2->save();

        $this->assertGreaterThan(0, $audience1->game_audience_id);
        $this->assertGreaterThan(0, $audience2->game_audience_id);

    }
}