<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('RoleSeeder');
        $this->command->info('Roles seeded!');

        $this->call('ClientSeeder');
        $this->command->info('Clients seeded!');

        $this->call('MemberSeeder');
        $this->command->info('Members seeded!');
	}

}