<?php

class BudgetGroupSeeder extends Seeder{

    public function run(){

        // exacte groups TBD

        BudgetGroup::create([
            'budget_group_value' => '0-20 EUR'
        ]);

        BudgetGroup::create([
            'budget_group_value' => '20-40 EUR'
        ]);

        BudgetGroup::create([
            'budget_group_value' => '40-60 EUR'
        ]);
        BudgetGroup::create([
           'budget_group_value' => '+60 EUR'
        ]);

    }

} 