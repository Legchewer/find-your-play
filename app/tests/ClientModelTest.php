<?php

class ClientModelTest extends TestCase
{

    /**
     * Test voor het model Client
     * @group client
     */
    public function testClientModel()
    {
        $person = Person::find(2);

        $client = new Client();

        $client->person()->associate($person);

        $client->save();

        // attach game and info

        $client->games()->attach(1, ['client_game_evaluation' => 3, 'client_game_duration' => '2 uren', 'client_game_feedback' => 'Erg goede feedback', 'client_game_shared' => 1]);


        $this->assertGreaterThan(0, $client->client_id);

    }
}