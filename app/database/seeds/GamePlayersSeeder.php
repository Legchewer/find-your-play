<?php

class GamePlayersSeeder extends Seeder{

    public function run(){

        GamePlayers::create([
            'game_players_name_nl' => 'Alleen',
            'game_players_name_en' => 'Alone'
        ]);

        GamePlayers::create([
            'game_players_name_nl' => '2-4 spelers',
            'game_players_name_en' => '2-4 players'
        ]);

        GamePlayers::create([
            'game_players_name_nl' => '+4 spelers',
            'game_players_name_en' => '+4 players'
        ]);

    }

} 