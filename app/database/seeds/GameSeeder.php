<?php

class GameSeeder extends Seeder{

    public function run(){

        // voorlopig maar 1 spel

        $game1 = Game::create([
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
            'game_duration_nl' => '15 min',
            'game_duration_en' => '15 min',
            'game_players' => '1',
            'game_therapeutic_nl' => 'therapeutische fiche',
            'game_therapeutic_en' => 'therapeutic file',
            // foreign keys
            'game_type_id' => 1,
            'game_difficulty_id' => 1,
            'budget_group_id' => 1,
            'theme_id' => 1
        ]);

        $game1->game_functions()->attach(1); // geheugen
        $game1->game_functions()->attach(6); // fijne motoriek
        $game1->game_functions()->attach(8); // snelheid
        $game1->game_functions()->attach(12); // alleen
        $game1->game_functions()->attach(21); // aanpassingsvermogen

        $game1->game_tags()->attach(1); // Nijntje NL
        $game1->game_tags()->attach(2); // konijn NL
        $game1->game_tags()->attach(3); // Nijntje EN
        $game1->game_tags()->attach(4); // rabbit EN

        // all features
        $game1->game_features()->attach(1);
        $game1->game_features()->attach(2);
        $game1->game_features()->attach(3);
        $game1->game_features()->attach(4);
        $game1->game_features()->attach(5);
        $game1->game_features()->attach(6);
        $game1->game_features()->attach(7);
        $game1->game_features()->attach(8);
        $game1->game_features()->attach(9);
        $game1->game_features()->attach(10);

    }

} 