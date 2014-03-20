<?php

class TherapyModelTest extends TestCase
{

    /**
     * Test voor het model Therapy
     * @group therapy
     */
    public function testTherapyModel()
    {

        $therapy1 = new Therapy();
        $therapy1->therapy_name_nl = 'Persoon';
        $therapy1->therapy_name_en = 'Person';

        $therapy1->save();

        $therapy2 = new Therapy();
        $therapy2->therapy_name_nl = 'Fysiek';
        $therapy2->therapy_name_en = 'Physical';

        $therapy2->parent_therapy()->associate($therapy1);

        $therapy2->save();

        $this->assertGreaterThan(0, $therapy1->therapy_id);
        $this->assertGreaterThan(0, $therapy2->therapy_id);

    }
}