<?php

class RoleModelTest extends TestCase
{

    /**
     * Test voor het model Role
     * @group role
     */
    public function testRoleModel()
    {

        $role1 = new Role();
        $role1->role_name_nl = "Admin";
        $role1->role_name_en = "Admin";

        $role2 = new Role();
        $role2->role_name_nl = "Ouder";
        $role2->role_name_en = "Parent";

        $role3 = new Role();
        $role3->role_name_nl = "Therapeut";
        $role3->role_name_en = "Therapist";

        $role1->save();
        $role2->save();
        $role3->save();

        $this->assertGreaterThan(0, $role1->role_id);
        $this->assertGreaterThan(0, $role2->role_id);
        $this->assertGreaterThan(0, $role3->role_id);

    }
}