<?php

class GameTypeModelTest extends TestCase
{

    /**
     * Test voor het model GameType
     * @group gametype
     */
    public function testGameTypeModel()
    {

        $kind = GameKind::find(1);

        $type1 = new GameType();
        $type1->game_type_name_nl = 'Schuifpuzzel';
        $type1->game_type_name_en = 'Sliding puzzle';

        $type1->game_kind()->associate($kind);

        $type1->save();

        $type2 = new GameType();
        $type2->game_type_name_nl = 'Vloerpuzzel';
        $type2->game_type_name_en = 'Floor puzzle';

        $type2->game_kind()->associate($kind);

        $type2->save();

        $this->assertGreaterThan(0, $type1->game_type_id);
        $this->assertGreaterThan(0, $type2->game_type_id);


    }
}