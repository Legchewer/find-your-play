<?php

class ThemeSeeder extends Seeder{

    public function run(){

        // exacte thema's TBD

        Theme::create([
            'theme_name_nl' => 'boerderij',
            'theme_name_en' => 'farm'
        ]);

        Theme::create([
            'theme_name_nl' => 'strand',
            'theme_name_en' => 'beach'
        ]);

        Theme::create([
            'theme_name_nl' => 'planten',
            'theme_name_en' => 'plants'
        ]);

        Theme::create([
            'theme_name_nl' => 'dieren',
            'theme_name_en' => 'animals'
        ]);

    }

} 