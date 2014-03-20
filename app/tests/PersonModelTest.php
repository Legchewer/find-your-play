<?php

class PersonModelTest extends TestCase
{

    /**
     * Test voor het model Person
     * @group person
     */
    public function testPersonModel()
    {
        $assign1 = [
            'person_givenname'  => 'Thomas',
            'person_surname' => 'Jacobs',
            'person_email'      => 'thomas.jacobs@student.arteveldehs.be',
        ];

        $person1 = new Person($assign1);

        $assign2 = [
            'person_givenname'  => 'Jorn',
            'person_surname' => 'Smits',
            'person_email'      => 'jorn.smits@student.arteveldehs.be',
        ];

        $person2 = new Person($assign2);

        $person1->save();
        $person2->save();

        $this->assertGreaterThan(0, $person1->person_id);
        $this->assertGreaterThan(0, $person2->person_id);

    }
}