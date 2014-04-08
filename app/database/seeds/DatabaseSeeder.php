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

        $this->call('GameKindSeeder');
        $this->command->info('Game kinds seeded!');

        $this->call('GameTypeSeeder');
        $this->command->info('Game types seeded!');

        $this->call('GameFunctionCategorySeeder');
        $this->command->info('Game functions seeded!');

        $this->call('GameFunctionSeeder');
        $this->command->info('Game functions seeded!');

        $this->call('ThemeSeeder');
        $this->command->info('Themes seeded!');

        $this->call('GameFeatureSeeder');
        $this->command->info('Game features seeded!');

        $this->call('GameDifficultySeeder');
        $this->command->info('Game difficulties seeded!');

        $this->call('GameTagSeeder');
        $this->command->info('Game tags seeded!');

        $this->call('BudgetGroupSeeder');
        $this->command->info('Budget groups seeded!');

        $this->call('GameSeeder');
        $this->command->info('Games seeded!');

        $this->call('RoleSeeder');
        $this->command->info('Roles seeded!');

        $this->call('ClientSeeder');
        $this->command->info('Clients seeded!');

        $this->call('MemberSeeder');
        $this->command->info('Members seeded!');

        $this->call('SettingSeeder');
        $this->command->info('Settings seeded!');

        $this->call('FeedbackSeeder');
        $this->command->info('Feedback seeded!');

	}

}