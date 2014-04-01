<?php

class GameDifficultySeeder extends Seeder{

    public function run(){

        GameDifficulty::create([
            'game_difficulty_name_nl' => 'gemakkelijk',
            'game_difficulty_name_en' => 'easy'
        ]);

        GameDifficulty::create([
            'game_difficulty_name_nl' => 'gewoon',
            'game_difficulty_name_en' => 'average'
        ]);

        GameDifficulty::create([
            'game_difficulty_name_nl' => 'moeilijk',
            'game_difficulty_name_en' => 'hard'
        ]);

    }

} 