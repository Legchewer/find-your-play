<?php

class GameFunctionCategoryModelTest extends TestCase
{

    /**
     * Test voor het model GameFunctionCategory
     * @group gamefunctioncategory
     */
    public function testGameFunctionCategoryModel()
    {

        $category1 = new GameFunctionCategory();
        $category1->game_function_category_name_nl = 'cognitief';
        $category1->game_function_category_name_en = 'cognitive';

        $category1->save();

        $category2 = new GameFunctionCategory();
        $category2->game_function_category_name_nl = 'emotioneel';
        $category2->game_function_category_name_en = 'emotional';

        $category2->save();

        $this->assertGreaterThan(0, $category1->game_function_category_id);
        $this->assertGreaterThan(0, $category2->game_function_category_id);


    }
}