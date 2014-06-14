<?php

class AdminGamePlayersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = GamePlayers::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $players = GamePlayers::orderBy('game_players_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $players = GamePlayers::orderBy('game_players_name_en', 'asc')->paginate(10);
        }

        return View::make('admin/players/index')
            ->with('players',$players)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/players/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'name_nl' => 'required_without:name_en' ,
            'name_en' => 'required_without:name_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $players = new GamePlayers();
            $players->game_players_name_nl = Input::get('name_nl');
            $players->game_players_name_en = Input::get('name_en');

            $players->save();

            return Redirect::route('admin.players');

        } else {
            return Redirect::route('admin.players.create')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $players = GamePlayers::find($id);

        return View::make('admin/players/edit')
            ->with('players',$players);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $players = GamePlayers::find($id);

        $rules = [
            'name_nl' => 'required_without:name_en' ,
            'name_en' => 'required_without:name_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values
            $players->game_players_name_nl = Input::get('name_nl');
            $players->game_players_name_en = Input::get('name_en');

            // save changes
            $players->save();

            return Redirect::route('admin.players');

        } else {

            return Redirect::to('admin/players/edit/' . $players->game_players_id)
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        GamePlayers::destroy($id);

        return Redirect::route('admin.players');
    }

}