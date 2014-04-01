<?php

class AgeGroupSeeder extends Seeder{

    public function run(){

        // NL EN ?

        AgeGroup::create([
            'age_group_value' => 'vanaf 3 jaar'
        ]);

        AgeGroup::create([
            'age_group_value' => 'vanaf 4 jaar'
        ]);

        AgeGroup::create([
            'age_group_value' => 'vanaf 5 jaar'
        ]);

        AgeGroup::create([
            'age_group_value' => 'vanaf 6 jaar'
        ]);

        AgeGroup::create([
            'age_group_value' => 'vanaf 7 jaar'
        ]);

        AgeGroup::create([
            'age_group_value' => 'vanaf 10 jaar'
        ]);

        AgeGroup::create([
            'age_group_value' => 'vanaf 12 jaar'
        ]);

    }

} 