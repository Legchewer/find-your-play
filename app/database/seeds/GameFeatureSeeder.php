<?php

class GameFeatureSeeder extends Seeder{

    public function run(){

        // test data game nijntje

        GameFeature::create([
            'game_feature_name' => 'afmeting puzzel',
            'game_feature_value' => 'L 50 cm/ B 30 cm/H 0 cm',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'measurements puzzle',
            'game_feature_value' => 'L 50 cm/ B 30 cm/H 0 cm',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'gemiddelde grootte stukken',
            'game_feature_value' => '4 cm',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'average size pieces',
            'game_feature_value' => '4 cm',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'aantal stukken',
            'game_feature_value' => '10',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'number of pieces',
            'game_feature_value' => '10',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'materiaal',
            'game_feature_value' => 'kunststof',
            'game_feature_lang' => 'NL',
        ]);

        GameFeature::create([
            'game_feature_name' => 'material',
            'game_feature_value' => 'synthetic',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'systeem verbinding',
            'game_feature_value' => 'geen verbinding',
            'game_feature_lang' => 'NL',
        ]);

        GameFeature::create([
            'game_feature_name' => 'system connection',
            'game_feature_value' => 'no connection',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'abstract/concreet',
            'game_feature_value' => 'abstract',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'abstract/concrete',
            'game_feature_value' => 'abstract',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'detail',
            'game_feature_value' => 'weinig',
            'game_feature_lang' => 'NL',
        ]);

        GameFeature::create([
            'game_feature_name' => 'detail',
            'game_feature_value' => 'little',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'figuur achtergrond',
            'game_feature_value' => 'duidelijk',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'figure background',
            'game_feature_value' => 'clear',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'sfeer',
            'game_feature_value' => 'ambiance',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'feel',
            'game_feature_value' => 'atmospheric',
            'game_feature_lang' => 'EN'
        ]);

        GameFeature::create([
            'game_feature_name' => 'geluksfactor',
            'game_feature_value' => 'gemiddeld',
            'game_feature_lang' => 'NL'
        ]);

        GameFeature::create([
            'game_feature_name' => 'luck factor',
            'game_feature_value' => 'average',
            'game_feature_lang' => 'EN',
        ]);

    }

} 