<?php

class FeedbackModelTest extends TestCase
{

    /**
     * Test voor het model Feedback
     * @group feedback
     */
    public function testFeedbackModel()
    {
        $member = Member::find(1);
        $game = Game::find(1);

        $feedback = new Feedback();

        $feedback->feedback_text = "dit is een feedback tekst";

        $feedback->member()->associate($member);

        $feedback->game()->associate($game);

        $feedback->save();

        $this->assertGreaterThan(0, $feedback->feedback_id);

    }
}