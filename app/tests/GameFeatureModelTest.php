<?php

class GameFeatureModelTest extends TestCase
{

    /**
     * Test voor het model GameFeature
     * @group gamefeature
     */
    public function testGameFeatureModel()
    {

        $feature1 = new GameFeature();
        $feature1->game_feature_name_nl = 'sfeer';
        $feature1->game_feature_name_en = 'feel';
        $feature1->game_feature_value_nl = 'ambiance';
        $feature1->game_feature_value_en = 'atmosphere';

        $feature2 = new GameFeature();
        $feature2->game_feature_name_nl = 'materiaal';
        $feature2->game_feature_name_en = 'material';
        $feature2->game_feature_value_nl = 'hout';
        $feature2->game_feature_value_en = 'wood';

        $feature3 = new GameFeature();
        $feature3->game_feature_name_nl = 'detail';
        $feature3->game_feature_name_en = 'detail';
        $feature3->game_feature_value_nl = 'weinig';
        $feature3->game_feature_value_en = 'little';

        $feature1->save();
        $feature2->save();
        $feature3->save();

        $this->assertGreaterThan(0, $feature1->game_feature_id);
        $this->assertGreaterThan(0, $feature2->game_feature_id);
        $this->assertGreaterThan(0, $feature3->game_feature_id);


    }
}