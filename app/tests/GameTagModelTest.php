<?php

class GameTagModelTest extends TestCase
{

    /**
     * Test voor het model GameTag
     * @group gametag
     */
    public function testGameTagModel()
    {

        $tag1 = new GameTag();
        $tag1->game_tag_value = "konijn";
        $tag1->game_tag_lang = "NL";

        $tag2 = new GameTag();
        $tag2->game_tag_value = "nijntje";
        $tag2->game_tag_lang = "NL";

        $tag3 = new GameTag();
        $tag3->game_tag_value = "rabbit";
        $tag3->game_tag_lang = "EN";

        $tag4 = new GameTag();
        $tag4->game_tag_value = "nijntje";
        $tag4->game_tag_lang = "EN";

        $tag1->save();
        $tag2->save();
        $tag3->save();
        $tag4->save();

        $this->assertGreaterThan(0, $tag1->game_tag_id);
        $this->assertGreaterThan(0, $tag2->game_tag_id);
        $this->assertGreaterThan(0, $tag3->game_tag_id);
        $this->assertGreaterThan(0, $tag4->game_tag_id);

    }
}