<?php

class MemberSeeder extends Seeder{

    public function run(){

        $person1 = Person::create([
           'person_givenname' => 'Thomas',
           'person_surname' => 'Jacobs',
           'person_email' => 'thomas.jacobs@student.arteveldehs.be'

        ]);

        $person2 = Person::create([
            'person_givenname' => 'Jorn',
            'person_surname' => 'Smits',
            'person_email' => 'jorn.smits@student.arteveldehs.be'

        ]);

        $person3 = Person::create([
            'person_givenname' => 'Gertjan',
            'person_surname' => 'Goetynck',
            'person_email' => 'gertjan.goetynck@student.arteveldehs.be'

        ]);

        $person4 = Person::create([
            'person_givenname' => 'Frank',
            'person_surname' => 'Testers',
            'person_email' => 'frank.testers@email.com'

        ]);

        $admin1 = Member::create([
            'member_password' => 'findyourplay' ,
            'role_id' => 1
        ]);
        $admin1->person()->associate($person1);

        $admin2 = Member::create([
            'member_password' => 'findyourplay' ,
            'role_id' => 1
        ]);
        $admin2->person()->associate($person2);

        $admin3 = Member::create([
            'member_password' => 'findyourplay' ,
            'role_id' => 1
        ]);
        $admin3->person()->associate($person3);

        $admin4 = Member::create([
            'member_password' => 'test' ,
            'role_id' => 2
        ]);
        $admin4->person()->associate($person4);

    }

} 