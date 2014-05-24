<?php

class AdminGamePlayersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //FOUT
        // $array['kind'] is, vermoed ik, een geselecteerde spelsoort bij filtering
        // $gamekind = GameType::where('game_kind_id','=',$array['kind'])->lists('game_type_id');

        // hij wil de kind ophalen van de gelinkte game_type ofzo?

        // foreach en wat doet hij met $game?

        //$games = Game::all();

        //foreach($games as $g){
            /*$game = $g->where(function($query)use($array)
            {
                if($array['difficulty'] != 'null'){
                    $query->where('game_difficulty_id','=',$array['difficulty']);
                }
                if($array['producer'] != 'null'){
                    $query->where('game_producer','=',$array['producer']);
                }
                if($array['theme'] != 'null'){
                    $query->where('game_theme_id','=',$array['theme']);
                }
            });*/
            // nut van $game?

            // controle op gameFeatures
            /*foreach($g->gameFeatures as $feature){
                var_dump($feature->game_feature_id); // check doen en game toevoegen aan results tabel (waarschijnlijk minder performante methode)
            }*/

            //var_dump($g->gameFeatures);
        //}

        //$games = Game::where()

        // feature of tag (pivot table example)

        /*$games = GameFeature::find(18)->games()->get();

        foreach($games as $game){
            var_dump($game->game_title_nl); // werkt
        }*/

        // game kind

        /* starten met game kind id

        $games_results = [];

        $gametypes = GameKind::find(1)->gameTypes()->get();

        foreach($gametypes as $type){
            $games = $type->games()->get();

            array_push($games_results, $games);
        }

        var_dump($games_results);*/

        // ECHTE CODE

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

    // op zoekpagina via search button
// probleem:
// hey thomas, ik zit met een probleem ivm eager loading voor de zoekfunctie. De zoekfunctie werkt nu al volledig buiten op 2 velden nl. game function en game kind , dit omdat beide gegevens uit een andere tabel komen en ik kan de tabelnaam niet aanspreken om gelijk te stellen aan de id die ik krijg van de zoekfunctie, weet jij hier soms hulp voor? ik zal de code posten hier met het bestand

// WSS gaan tags ook niet


// TODO's van mij

    public function FilterIndex()
    {
        // alle spellen
        //$games = Game::with('gameFunctions','gameType')->get();
        $games = Game::all();

        // nederlands
        if(App::getLocale() == 'nl')
        {
            // selects opvullen
            $game_kinds = GameKind::where('game_kind_name_nl','!=','')->lists('game_kind_name_nl','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_nl','game_difficulty_id');
            $game_themes = Theme::where('theme_name_nl','!=','')->lists('theme_name_nl','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_nl','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_nl','game_players_id');
            $game_age = Game::groupBy('game_age_nl')->lists('game_age_nl','game_age_nl');

            // als zoekquery index bestaat
            $search_index = Session::get('index_search'); // TODO : liefst niet met sessions werken, maar met functie parameter

            // zoekquery niet leeg
            if($search_index != '')
            {
                // alle thema's ophalen die zoek query kan bevatten
                $themes = Theme::where('theme_name_nl','like','%' . $search_index . '%')->get();
                // id ophalen van thema van zoekquery
                foreach($themes as $theme)
                {
                    $id = $theme->theme_id;
                }
                // als zoekquery thema was
                if(!$themes->isEmpty())
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('theme_id','=',$id)
                            ->orWhere('game_title_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_description_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_producer','LIKE','%' . $search_index . '%')
                            ->select('game_title_nl as game_title','game_description_nl as game_description')
                            ->get();
                    }
                }
                // zoekquery was geen thema, zoek op title, description, producer
                else
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('game_title_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_description_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_producer','LIKE','%' . $search_index . '%')
                            ->select('game_title_nl as game_title','game_description_nl as game_description')
                            ->get();
                    }
                }
            }

            // als zoekquery search bestaat
            $search = Session::get('search_post');
            // zoekquery niet leeg
            if($search != '')
            {
                function multiexplode ($delimiters,$search) {

                    $ready = str_replace($delimiters, $delimiters[0], $search);
                    $launch = explode($delimiters[0], $ready);
                    return  $launch;
                }

                $searchterms = multiexplode(array("=","."),$search);
                $odd = array();
                $even = array();
                foreach ($searchterms as $k => $v) {
                    if ($k % 2 == 0) {
                        $even[] = $v;
                    }
                    else {
                        $odd[] = $v;
                    }
                }
                $array = array_combine($even,$odd);
                var_dump($array);
                $gamekind = GameType::where('game_kind_id','=',$array['kind'])->lists('game_type_id');
                var_dump($gamekind);

                foreach($games as $g)
                {
                    $game = /*$g->where(function($query)use($array)
                           {
                               if($array['difficulty'] != 'null'){
                                   $query->where('game_difficulty_id','=',$array['difficulty']);
                               }
                               if($array['producer'] != 'null'){
                                   $query->where('game_producer','=',$array['producer']);
                               }
                               if($array['theme'] != 'null'){
                                   $query->where('game_theme_id','=',$array['theme']);
                               }
                               /*if($array['function'] != 'null'){
                                   $query->where('gameFunctions.game_function_id','=',$array['function']);
                               }*/
                        /*if($array['budget'] != 'null'){
                            $query->where('budget_group_id','=',$array['budget']);
                        }
                        if($array['players'] != 'null'){
                            $query->where('game_players','=',$array['players']);
                        }
                        if($array['age'] != 'null'){
                            $query->where('game_age_nl','=',$array['age']);
                        }
                    })*/
                        /*$g->with(array('gameType' => function($query)use($array){
                             if($array['kind'] != 'null'){
                                 $query->where('game_function_id','=',$array['kind']);
                             }
                        }))*/
                        $g->with(array('GameType' => function($query){
                                $query->where('game_function_id','=',1);
                            }))
                            ->select("game_title_nl as game_title","game_description_nl as game_description")
                            ->get();
                }
            }

            if($search_index == null && $search == null)
            {
                foreach($games as $g)
                {
                    $game = $g->select('game_title_nl as game_title','game_description_nl as game_description')
                        ->get();
                }
            }
        }
        // engels
        else
        {
            $game_kinds = GameKind::where('game_kind_name_en','!=','')->lists('game_kind_name_en','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_en','game_difficulty_id');
            $game_themes = Theme::where('theme_name_en','!=','')->lists('theme_name_en','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_en','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_en','game_players_id');
            $game_age = Game::groupBy('game_age_en')->lists('game_age_en','game_age_en');

            foreach($games as $g)
            {
                $game = $g->select('game_title_en as game_title','game_description_en as game_description')
                    ->get();
            }
        }

        // beide talen hetzelfde in select
        $game_producer = Game::groupBy('game_producer')->lists('game_producer','game_producer');
        $game_budget = BudgetGroup::lists('budget_group_value','budget_group_id');

        return View::make('web.spelzoeken', compact('game_kinds','game_difficulties', 'game_producer','game_themes','game_functions','game_budget','game_players','game_age'),['games' => $game]);

    }

}

