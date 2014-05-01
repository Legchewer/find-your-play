<?php

class AdminGameController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = Game::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $games = Game::orderBy('game_type_id', 'asc')->orderBy('game_title_nl')->paginate(10);

        }
        else
        {
            $games = Game::orderBy('game_type_id', 'asc')->orderBy('game_title_en')->paginate(10);

        }

        return View::make('admin/games/index')
            ->with('games',$games)
            ->with('count',$count);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Game::destroy($id);

        return Redirect::route('admin.games');
    }

}