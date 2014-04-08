<?php

class GameKindSeeder extends Seeder{

    public function run(){

        // 7 spelsoorten

        GameKind::create([
            'game_kind_name_nl' => 'puzzel',
            'game_kind_name_en' => 'puzzle'
        ]);

        GameKind::create([
            'game_kind_name_nl' => 'bouwspel',
            'game_kind_name_en' => ''
        ]);

        GameKind::create([
            'game_kind_name_nl' => 'constructiespel',
            'game_kind_name_en' => ''
        ]);

        GameKind::create([
            'game_kind_name_nl' => 'dobbelspel',
            'game_kind_name_en' => 'dice game'
        ]);

        GameKind::create([
            'game_kind_name_nl' => 'kaartspel',
            'game_kind_name_en' => 'card game'
        ]);

        GameKind::create([
            'game_kind_name_nl' => 'bordspel',
            'game_kind_name_en' => 'board game'
        ]);

        GameKind::create([
            'game_kind_name_nl' => 'aanlegspel',
            'game_kind_name_en' => ''
        ]);

    }

} 