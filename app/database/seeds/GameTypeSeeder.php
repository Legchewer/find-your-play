<?php

class GameTypeSeeder extends Seeder{

    public function run(){

        ProblemCategory::create([
            'problemcategory_name_nl' => 'ademhalingsstelsel' ,
            'problemcategory_name_en' => 'respiratory system'
        ]);



    }

} 