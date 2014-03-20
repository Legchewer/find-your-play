<?php

class MemberModelTest extends TestCase
{

    /**
     * Test voor het model Member
     * @group member
     */
    public function testMemberModel()
    {
        $person = Person::find(1);
        $role = Role::find(1);

        $member1 = new Member();

        // PASS & SALT
        $password1 = Hash::make('findyourplay');
        $member1->member_password = $password1;

        $member1->person()->associate($person);
        $member1->role()->associate($role);

        $member1->save();

        $member1->clients()->attach(1);

        $this->assertGreaterThan(0, $member1->member_id);

    }

}