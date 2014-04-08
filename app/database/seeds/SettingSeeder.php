<?php

class SettingSeeder extends Seeder{

    public function run(){

        Setting::create([
            'setting_name_nl' => 'Nederlands',
            'setting_name_en' => 'Dutch',
            'setting_value_nl' => 'true',
            'setting_value_en' => 'true',
        ]);

        Setting::create([
            'setting_name_nl' => 'Engels',
            'setting_name_en' => 'English',
            'setting_value_nl' => 'false',
            'setting_value_en' => 'false',
        ]);

    }

} 