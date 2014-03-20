<?php

class AgeGroupModelTest extends TestCase
{

    /**
     * Test voor het model AgeGroup
     * @group agegroup
     */
    public function testAgeGroupModel()
    {

        $agegroup1 = new AgeGroup();
        $agegroup1->age_group_value = "0-4";

        $agegroup2 = new AgeGroup();
        $agegroup2->age_group_value = "4-8";

        $agegroup1->save();
        $agegroup2->save();

        $this->assertGreaterThan(0, $agegroup1->age_group_id);
        $this->assertGreaterThan(0, $agegroup2->age_group_id);

    }
}