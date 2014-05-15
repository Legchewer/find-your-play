<?php

class GameController extends \BaseController {

    public function Index($id)
    {

        $game = Game::find($id);

        return View::make('web.speldetail',['game' => $game]);
    }
}