<?php

class BudgetGroupModelTest extends TestCase
{

    /**
     * Test voor het model BudgetGroup
     * @group budgetgroup
     */
    public function testBudgetGroupModel()
    {

        $budgetgroup1 = new BudgetGroup();
        $budgetgroup1->budget_group_value = "20-40 EUR";

        $budgetgroup1->save();

        $budgetgroup2 = new BudgetGroup();
        $budgetgroup2->budget_group_value = "40-80 EUR";

        $budgetgroup2->save();

        $this->assertGreaterThan(0, $budgetgroup1->budget_group_id);
        $this->assertGreaterThan(0, $budgetgroup2->budget_group_id);

    }
}