<?php

class ThemeModelTest extends TestCase
{

    /**
     * Test voor het model Theme
     * @group theme
     */
    public function testThemeModel()
    {

        $theme1 = new Theme();
        $theme1->theme_name_nl = 'Boerderij';
        $theme1->theme_name_en = 'Farm';

        $theme1->save();

        $this->assertGreaterThan(0, $theme1->theme_id);

    }
}