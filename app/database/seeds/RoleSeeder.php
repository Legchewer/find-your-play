<?php

class RoleSeeder extends Seeder{

    public function run(){

        Role::create([
            'role_name_nl' => 'admin',
            'role_name_en' => 'admin'
        ]);

        Role::create([
            'role_name_nl' => 'therapeut',
            'role_name_en' => 'therapist'
        ]);

        Role::create([
            'role_name_nl' => 'ouder',
            'role_name_en' => 'parent'
        ]);

    }

} 