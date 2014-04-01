<?php

class ClientSeeder extends Seeder{

    public function run(){

        $person1 = Person::create([
           'person_givenname' => 'Jonas',
           'person_surname' => 'Van der Testen',
           'person_email' => 'jonas-vdt@email.com'

        ]);

        $person2 = Person::create([
            'person_givenname' => 'Sara',
            'person_surname' => 'Van der Testen',
            'person_email' => 'sara-vdt@email.com'

        ]);

        $client1 = Client::create([
            'client_experience' => '<p>Heel obsessief bezig met de spelletjes.</p>',
            'person_id' => 1
        ]);

        $client2 = Client::create([
            'client_experience' => '<p>Kruipt vaak in haar schulp.</p>',
            'person_id' => 2
        ]);

        // TODO link games

    }

} 