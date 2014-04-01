<?php

class UserSeeder extends Seeder{

    public function run(){

        $superadmin = User::create([
            'user_email' => 'thomas.jacobs@student.arteveldehs.be' ,
            'user_givenname' => 'Thomas',
            'user_surname' => 'Jacobs',
            'user_password' => 'elytra',
            'role_id' => 1
        ]);

    }

} 