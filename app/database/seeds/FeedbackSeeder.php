<?php

class FeedbackSeeder extends Seeder{

    public function run(){

        Feedback::create([
            'feedback_text' => 'Leuk spel!',
            'game_id' => 1,
            'member_id' => 1
        ]);

        Feedback::create([
            'feedback_text' => 'Goed gemaakt',
            'game_id' => 1,
            'member_id' => 2
        ]);

    }

} 