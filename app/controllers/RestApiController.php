<?php

class RestApiController extends \BaseController {

    /**
     * Display functions for a specified game
     *
     * @param  int  $id
     * @return Response
     */
    public function getFunctionsForGame($id)
    {
        $game = Game::find($id);

        return Response::json($game->gameFunctions)
            ->setCallback(Input::get('callback'));
    }

}