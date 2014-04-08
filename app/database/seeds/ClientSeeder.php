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

        $client1->games()->attach(1, ['client_game_usedate'=>date("Y-m-d H:i:s"), 'client_game_evaluation'=>4, 'client_game_duration'=>'30 min', 'client_game_log'=>'<p>Alles verloopt vlot. Er worden vorderingen gemaakt</p>']);

        $client2 = Client::create([
            'client_experience' => '<p>Kruipt vaak in haar schulp.</p>',
            'person_id' => 2
        ]);

        $client2->games()->attach(1, ['client_game_usedate'=>date("Y-m-d H:i:s"), 'client_game_evaluation'=>2, 'client_game_duration'=>'30 min', 'client_game_log'=>'<p>Ze vertoonde weinig interesse.</p>']);

    }

} 