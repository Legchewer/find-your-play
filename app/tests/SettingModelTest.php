<?php

class SettingModelTest extends TestCase
{

    /**
     * Test voor het model Setting
     * @group setting
     */
    public function testSettingModel()
    {

        $setting1 = new Setting();
        $setting1->setting_name_nl = 'Nederlands';
        $setting1->setting_name_en = 'Dutch';
        $setting1->setting_value_nl = 'true';
        $setting1->setting_value_en = 'true';

        $setting2 = new Setting();
        $setting2->setting_name_nl = 'Engels';
        $setting2->setting_name_en = 'English';
        $setting2->setting_value_nl = 'false';
        $setting2->setting_value_en = 'false';

        $setting1->save();
        $setting2->save();

        $this->assertGreaterThan(0, $setting1->setting_id);
        $this->assertGreaterThan(0, $setting2->setting_id);


    }
}