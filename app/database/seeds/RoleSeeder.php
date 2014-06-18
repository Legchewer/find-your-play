<?php

class RoleSeeder extends Seeder{

    public function run(){

        Role::create([
            'role_name_nl' => 'Admin',
            'role_name_en' => 'Admin'
        ]);

        Role::create([
            'role_name_nl' => 'Therapeut',
            'role_name_en' => 'Therapist'
        ]);

        Role::create([
            'role_name_nl' => 'Ouder',
            'role_name_en' => 'Parent'
        ]);
        Role::create([
            'role_name_nl' => 'Begeleider',
            'role_name_en' => 'Supervisor'
        ]);
    }

} 