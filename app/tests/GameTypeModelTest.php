<?php

class GameTypeModelTest extends TestCase
{

    /**
     * Test voor het model GameType
     * @group gametype
     */
    public function testGameTypeModel()
    {

        $type1 = new GameType();
        $type1->game_type_name_nl = 'Puzzel';
        $type1->game_type_name_en = 'Puzzle';

        $type1->save();

        $type2 = new GameType();
        $type2->game_type_name_nl = 'Rollenspel';
        $type2->game_type_name_en = 'Role-playing';

        $type2->save();

    }
}