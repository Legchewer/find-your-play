<?php

class AdminGameController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        // get count of all games
        $count = Game::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $games = Game::orderBy('game_type_id', 'asc')->orderBy('game_title_nl', 'asc')->paginate(10);

        }
        else
        {
            $games = Game::orderBy('game_type_id', 'asc')->orderBy('game_title_en', 'asc')->paginate(10);

        }

        return View::make('admin/games/index')
            ->with('games',$games)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // create appropriate ddl according to current locale
        if (App::getLocale() == 'nl')
        {

            $types = GameType::lists('game_type_name_nl','game_type_id');
            $difficulties = GameDifficulty::lists('game_difficulty_name_nl','game_difficulty_id');
            $themes = Theme::lists('theme_name_nl','theme_id');
            $functions = GameFunction::lists('game_function_name_nl','game_function_id');
            $budgetgroups = BudgetGroup::lists('budget_group_value','budget_group_id');
            $players = GamePlayers::lists('game_players_name_nl','game_players_id');
        }
        else {
            $types = GameType::lists('game_type_name_en','game_type_id');
            $difficulties = GameDifficulty::lists('game_difficulty_name_en','game_difficulty_id');
            $themes = Theme::lists('theme_name_en','theme_id');
            $functions = GameFunction::lists('game_function_name_en','game_function_id');
            $budgetgroups = BudgetGroup::lists('budget_group_value','budget_group_id');
            $players = GamePlayers::lists('game_players_name_en','game_players_id');
        }

        return View::make('admin/games/create')
            ->with('types',$types)
            ->with('difficulties',$difficulties)
            ->with('themes',$themes)
            ->with('functions',$functions)
            ->with('budgetgroups',$budgetgroups)
            ->with('players',$players);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $rules = [
            'title_nl' => 'required_without:title_en' ,
            'title_en' => 'required_without:title_nl',
            'producer' => 'required',
            'players' => 'required',
            'functions' => 'required',
            'icon' => 'image|mimes:jpg,jpeg,gif,png', // TODO : MEER?

        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $game = new Game();
            $game->game_title_nl = Input::get('title_nl');
            $game->game_title_en = Input::get('title_en');
            $game->game_description_nl = Input::get('description_nl');
            $game->game_description_en = Input::get('description_en');
            $game->game_age_nl = Input::get('age_nl');
            $game->game_age_en = Input::get('age_en');
            $game->game_price = Input::get('price');
            $game->game_producer = Input::get('producer');
            $game->game_availability = Input::get('availability');
            $game->game_rules_nl = Input::get('rules_nl');
            $game->game_rules_en = Input::get('rules_en');
            $game->game_duration_nl = Input::get('duration_nl');
            $game->game_duration_en = Input::get('duration_en');
            $game->game_therapeutic_nl = Input::get('therapeutic_nl');
            $game->game_therapeutic_en = Input::get('therapeutic_en');

            $type = GameType::find(Input::get('type'));
            $game->gameType()->associate($type);

            $difficulty = GameDifficulty::find(Input::get('difficulty'));
            $game->gameDifficulty()->associate($difficulty);

            $budgetgroup = BudgetGroup::find(Input::get('budgetgroup'));
            $game->budgetGroup()->associate($budgetgroup);

            $theme = Theme::find(Input::get('theme'));
            $game->theme()->associate($theme);

            $players = GamePlayers::find(Input::get('players'));
            $game->gamePlayers()->associate($players);

            // if file is not empty
            if(Input::file('image')){

                // haal file upload
                $image = Input::file('image');

                $filename = $image->getClientOriginalName();

                // store image in folder
                $destination = 'uploads/images';

                Input::file('image')->move($destination, $filename);

                // store name in database
                $game->game_image = $filename;
            }

            $game->save();

            // add functions
            $functions = Input::get('functions');

            foreach($functions as $function){
                $game->gameFunctions()->attach($function);
            }

            // add new tags

            if(Input::get('tags_nl')){
                $tags_nl_arr = explode(',', Input::get('tags_nl'));

                foreach($tags_nl_arr as $tag){
                    $new_tag = new GameTag();

                    $new_tag->game_tag_value = str_replace(' ','',$tag);
                    $new_tag->game_tag_lang = "NL";

                    $new_tag->save();

                    $game->gameTags()->attach($new_tag);
                }
            }

            if(Input::get('tags_nl')){
                $tags_en_arr = explode(',', Input::get('tags_en'));

                foreach($tags_en_arr as $tag){
                    $new_tag = new GameTag();

                    $new_tag->game_tag_value = str_replace(' ','',$tag);
                    $new_tag->game_tag_lang = "EN";

                    $new_tag->save();

                    $game->gameTags()->attach($new_tag);
                }
            }

            // add new features

            if(Input::get('features_nl')){
                $features_nl_arr = explode('</p><p>', Input::get('features_nl'));

                foreach($features_nl_arr as $feature){
                    $new_feature = new GameFeature();

                    // clean up feature of remaining tags
                    $feature = str_replace('<p>','', $feature);
                    $feature = str_replace('</p>','', $feature);

                    $feature_split = explode(',', $feature);

                    $new_feature->game_feature_name = str_replace(' ','',$feature_split[0]);
                    $new_feature->game_feature_value = str_replace(' ','',$feature_split[1]);
                    $new_feature->game_feature_lang = 'NL';

                    $new_feature->save();

                    $game->gameFeatures()->attach($new_feature);
                }
            }

            if(Input::get('features_en')){
                $features_en_arr = explode('</p><p>', Input::get('features_en'));

                foreach($features_en_arr as $feature){
                    $new_feature = new GameFeature();

                    // clean up feature of remaining tags
                    $feature = str_replace('<p>','', $feature);
                    $feature = str_replace('</p>','', $feature);

                    $feature_split = explode(',', $feature);

                    $new_feature->game_feature_name = str_replace(' ','',$feature_split[0]);
                    $new_feature->game_feature_value = str_replace(' ','',$feature_split[1]);
                    $new_feature->game_feature_lang = 'EN';

                    $new_feature->save();

                    $game->gameFeatures()->attach($new_feature);
                }
            }

            return Redirect::route('admin.games');

        } else {
            return Redirect::route('admin.games.create')
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
        Game::destroy($id);

        return Redirect::route('admin.games');
    }

}