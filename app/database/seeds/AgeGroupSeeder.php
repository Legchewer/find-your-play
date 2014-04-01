<?php

class GameTypeSeeder extends Seeder{

    public function run(){

        GameType::create([
            'game_type_name_nl' => 'vormenstoof',
            'game_type_name_en' => ''
        ]);

        GameType::create([
            'game_type_name_nl' => 'schuifpuzzel',
            'game_type_name_en' => ''
        ]);

        GameType::create([
            'game_type_name_nl' => 'nopjespuzzel',
            'game_type_name_en' => ''
        ]);

        GameType::create([
            'game_type_name_nl' => 'vloerpuzzel',
            'game_type_name_en' => 'floor puzzle'
        ]);

        GameType::create([
            'game_type_name_nl' => 'schuifpuzzel',
            'game_type_name_en' => 'sliding puzzle'
        ]);

        GameType::create([
            'game_type_name_nl' => 'legpuzzel',
            'game_type_name_en' => ''
        ]);

        GameType::create([
            'game_type_name_nl' => '3D puzzel',
            'game_type_name_en' => '3D puzzle'
        ]);

    }

} 