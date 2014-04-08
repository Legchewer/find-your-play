<?php

class GameTagSeeder extends Seeder{

    public function run(){

        // tags for test game nijntje

        GameTag::create([
            'game_tag_value' => 'nijntje',
            'game_tag_lang' => 'NL'
        ]);

        GameTag::create([
            'game_tag_value' => 'konijn',
            'game_tag_lang' => 'NL'
        ]);

        GameTag::create([
            'game_tag_value' => 'nijntje',
            'game_tag_lang' => 'EN'
        ]);

        GameTag::create([
            'game_tag_value' => 'rabbit',
            'game_tag_lang' => 'EN'
        ]);

    }

} 