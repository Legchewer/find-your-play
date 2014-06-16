<?php

class SettingSeeder extends Seeder{

    public function run(){

        Setting::create([
            'setting_name_nl' => 'Nederlands',
            'setting_name_en' => 'Dutch',
            'setting_value_nl' => '1',
            'setting_value_en' => '1',
        ]);

        Setting::create([
            'setting_name_nl' => 'Engels',
            'setting_name_en' => 'English',
            'setting_value_nl' => '0',
            'setting_value_en' => '0',
        ]);

    }

} 