<?php

class GameFunctionModelTest extends TestCase
{

    /**
     * Test voor het model GameFunction
     * @group gamefunction
     */
    public function testGameFunctionModel()
    {
        $category1 = GameFunctionCategory::find(1);
        $category2 = GameFunctionCategory::find(2);

        $function1 = new GameFunction();
        $function1->game_function_name_nl = 'Logica';
        $function1->game_function_name_en = 'Logic';

        $function1->game_function_category()->associate($category1);

        $function1->save();

        $function2 = new GameFunction();
        $function2->game_function_name_nl = 'Reactievermogen';
        $function2->game_function_name_en = 'Reaction time';

        $function2->game_function_category()->associate($category2);

        $function2->save();

        $this->assertGreaterThan(0, $function1->game_function_id);
        $this->assertGreaterThan(0, $function2->game_function_id);


    }
}