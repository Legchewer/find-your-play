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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/difficulties/create');
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

            $difficulty = new GameDifficulty();
            $difficulty->game_difficulty_name_nl = Input::get('name_nl');
            $difficulty->game_difficulty_name_en = Input::get('name_en');

            $difficulty->save();

            return Redirect::route('admin.difficulties');

        } else {
            return Redirect::route('admin.difficulties.create')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
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
        GameDifficulty::destroy($id);

        return Redirect::route('admin.difficulties');
    }

}