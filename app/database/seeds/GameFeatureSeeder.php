<?php

class GameFeatureSeeder extends Seeder{

    public function run(){

        // test data game nijntje

        GameFeature::create([
            'game_feature_name_nl' => 'afmeting puzzel',
            'game_feature_name_en' => 'measurements puzzle',
            'game_feature_value_nl' => 'L 50 cm/ B 30 cm/H 0 cm',
            'game_feature_value_en' => 'L 50 cm/ B 30 cm/H 0 cm'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'gemiddelde grootte stukken',
            'game_feature_name_en' => 'average size pieces',
            'game_feature_value_nl' => '4 cm',
            'game_feature_value_en' => '4 cm'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'aantal stukken',
            'game_feature_name_en' => 'number of pieces',
            'game_feature_value_nl' => '10',
            'game_feature_value_en' => '10'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'materiaal',
            'game_feature_name_en' => 'material',
            'game_feature_value_nl' => 'kunststof',
            'game_feature_value_en' => 'synthetic'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'systeem verbinding',
            'game_feature_name_en' => 'system connection',
            'game_feature_value_nl' => 'geen verbinding',
            'game_feature_value_en' => 'no connection'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'abstract/concreet',
            'game_feature_name_en' => 'abstract/concrete',
            'game_feature_value_nl' => 'abstract',
            'game_feature_value_en' => 'abstract'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'detail',
            'game_feature_name_en' => 'detail',
            'game_feature_value_nl' => 'weinig',
            'game_feature_value_en' => 'little'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'figuur achtergrond',
            'game_feature_name_en' => 'figure background',
            'game_feature_value_nl' => 'duidelijk',
            'game_feature_value_en' => 'clear'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'sfeer',
            'game_feature_name_en' => 'feel',
            'game_feature_value_nl' => 'ambiance',
            'game_feature_value_en' => 'atmospheric'
        ]);

        GameFeature::create([
            'game_feature_name_nl' => 'geluksfactor',
            'game_feature_name_en' => 'luck factor',
            'game_feature_value_nl' => 'gemiddeld',
            'game_feature_value_en' => 'average'
        ]);

    }

} 