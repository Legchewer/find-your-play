<?php

class AdminGameDifficultyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = GameDifficulty::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $difficulties = GameDifficulty::orderBy('game_difficulty_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $difficulties = GameDifficulty::orderBy('game_difficulty_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/difficulties/index')
            ->with('difficulties',$difficulties)
            ->with('count',$count);
	}

}