<?php

class GameFunctionSeeder extends Seeder{

    public function run(){

        // kan nog veranderen

        // COGNITIEF

        GameFunction::create([
            'game_function_name_nl' => 'geheugen',
            'game_function_name_en' => 'memory',
            'game_function_category_id' => 1
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'logica',
            'game_function_name_en' => 'logic',
            'game_function_category_id' => 1
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'aandacht',
            'game_function_name_en' => '',
            'game_function_category_id' => 1
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'taal',
            'game_function_name_en' => 'language',
            'game_function_category_id' => 1
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'ruimteljk inzicht',
            'game_function_name_en' => '',
            'game_function_category_id' => 1
        ]);

        // FYSIEK

        GameFunction::create([
            'game_function_name_nl' => 'fijne motoriek',
            'game_function_name_en' => '',
            'game_function_category_id' => 2
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'coördinatie',
            'game_function_name_en' => 'coordination',
            'game_function_category_id' => 2
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'snelheid',
            'game_function_name_en' => 'speed',
            'game_function_category_id' => 2
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'kracht',
            'game_function_name_en' => 'strength',
            'game_function_category_id' => 2
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'spierspanning',
            'game_function_name_en' => 'muscle tension',
            'game_function_category_id' => 2
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'stabiliteit',
            'game_function_name_en' => '',
            'game_function_category_id' => 2
        ]);

        // SOCIAAL

        GameFunction::create([
            'game_function_name_nl' => 'alleen',
            'game_function_name_en' => 'alone',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'bluffen',
            'game_function_name_en' => 'bluffing',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'gokken',
            'game_function_name_en' => 'gambling',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'diplomatie',
            'game_function_name_en' => 'diplomacy',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'samenwerken',
            'game_function_name_en' => 'cooperation',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => '1 tegen allen',
            'game_function_name_en' => '',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'ruilen',
            'game_function_name_en' => 'trading',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'verzamelen',
            'game_function_name_en' => 'collecting',
            'game_function_category_id' => 3
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'samenspelen',
            'game_function_name_en' => '',
            'game_function_category_id' => 3
        ]);

        // EMOTIONEEL

        GameFunction::create([
            'game_function_name_nl' => 'aanpassingsvermogen',
            'game_function_name_en' => 'adjustability',
            'game_function_category_id' => 4
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'reactievermogen',
            'game_function_name_en' => '',
            'game_function_category_id' => 4
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'doorzettingsvermogen',
            'game_function_name_en' => 'perseverance',
            'game_function_category_id' => 4
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'openheid',
            'game_function_name_en' => '',
            'game_function_category_id' => 4
        ]);

        GameFunction::create([
            'game_function_name_nl' => 'geduld',
            'game_function_name_en' => 'patience',
            'game_function_category_id' => 4
        ]);

    }

} 