<?php

class GameTypeSeeder extends Seeder{

    public function run(){

        // PUZZELS

        GameType::create([
            'game_type_name_nl' => 'vormenstoof',
            'game_type_name_en' => '',
            'game_kind_id' => 1
        ]);

        GameType::create([
            'game_type_name_nl' => 'schuifpuzzel',
            'game_type_name_en' => 'sliding puzzle',
            'game_kind_id' => 1
        ]);

        GameType::create([
            'game_type_name_nl' => 'nopjespuzzel',
            'game_type_name_en' => '',
            'game_kind_id' => 1
        ]);

        GameType::create([
            'game_type_name_nl' => 'vloerpuzzel',
            'game_type_name_en' => 'floor puzzle',
            'game_kind_id' => 1
        ]);

        GameType::create([
            'game_type_name_nl' => 'legpuzzel',
            'game_type_name_en' => '',
            'game_kind_id' => 1
        ]);

        GameType::create([
            'game_type_name_nl' => '3D puzzel',
            'game_type_name_en' => '3D puzzle',
            'game_kind_id' => 1
        ]);

        // BOUWSPELEN

        GameType::create([
            'game_type_name_nl' => 'bouwspel', // er stond nvt in data
            'game_type_name_en' => '',
            'game_kind_id' => 2
        ]);

        // CONSTRUCTIESPELEN

        GameType::create([
            'game_type_name_nl' => 'constructiespel', // er stond nvt in data
            'game_type_name_en' => '',
            'game_kind_id' => 3
        ]);

        // DOBBELSPELEN

        GameType::create([
            'game_type_name_nl' => 'dobbelspel', // er stond nvt in data
            'game_type_name_en' => '',
            'game_kind_id' => 4
        ]);

    }

} 