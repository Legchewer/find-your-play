<?php

class ThemeModelTest extends TestCase
{

    /**
     * Test voor het model Theme
     * @group theme
     */
    public function testThemeModel()
    {

        $theme1 = new Theme(); // wss slecht vb
        $theme1->theme_name_nl = 'Middeleeuwen';
        $theme1->theme_name_en = 'Medieval';

        $theme1->save();

        $this->assertGreaterThan(0, $theme1->theme_id);

    }
}