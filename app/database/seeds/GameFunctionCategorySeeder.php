<?php

class GameFunctionCategorySeeder extends Seeder{

    public function run(){

        // 4 categories

        GameFunctionCategory::create([
            'game_function_category_name_nl' => 'cognitief',
            'game_function_category_name_en' => 'cognitive',
        ]);

        GameFunctionCategory::create([
            'game_function_category_name_nl' => 'fysiek',
            'game_function_category_name_en' => 'physical',
        ]);

        GameFunctionCategory::create([
            'game_function_category_name_nl' => 'sociaal',
            'game_function_category_name_en' => 'social',
        ]);

        GameFunctionCategory::create([
            'game_function_category_name_nl' => 'emotioneel',
            'game_function_category_name_en' => 'emotional',
        ]);

    }

} 