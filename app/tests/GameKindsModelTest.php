<?php

class GameKindModelTest extends TestCase
{

    /**
     * Test voor het model GameKind
     * @group gamekind
     */
    public function testGameKindModel()
    {
        $kind1 = new GameKind();
        $kind1->game_kind_name_nl = "Puzzel";
        $kind1->game_kind_name_en = "Puzzle";

        $kind2 = new GameKind();
        $kind2->game_kind_name_nl = "Bordspel";
        $kind2->game_kind_name_en = "Board game";

        $kind1->save();
        $kind2->save();

        $this->assertGreaterThan(0, $kind1->game_kind_id);
        $this->assertGreaterThan(0, $kind2->game_kind_id);

    }
}