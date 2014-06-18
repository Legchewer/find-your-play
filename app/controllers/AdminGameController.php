<?php

class AdminGameController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        /*$client = Client::find(1);

        foreach($client->games as $game){

            var_dump($game->pivot->client_game_evaluation);

        }*/

        ///////

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
            'age_nl' => 'required_without:age_en',
            'age_en' => 'required_without:age_nl',
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
                $features_nl_arr = explode(PHP_EOL, Input::get('features_nl'));

                foreach($features_nl_arr as $feature){
                    $new_feature = new GameFeature();

                    $feature_split = explode(',', $feature);

                    $new_feature->game_feature_name = str_replace(' ','',$feature_split[0]);
                    $new_feature->game_feature_value = str_replace(' ','',$feature_split[1]);
                    $new_feature->game_feature_lang = 'NL';

                    $new_feature->save();

                    $game->gameFeatures()->attach($new_feature);
                }
            }

            if(Input::get('features_en')){
                $features_en_arr = explode('PHP_EOL', Input::get('features_en'));

                foreach($features_en_arr as $feature){
                    $new_feature = new GameFeature();

                    $feature_split = explode(',', $feature);

                    $new_feature->game_feature_name = str_replace(' ','',$feature_split[0]);
                    $new_feature->game_feature_value = str_replace(' ','',$feature_split[1]);
                    $new_feature->game_feature_lang = 'EN';

                    $new_feature->save();

                    $game->gameFeatures()->attach($new_feature);
                }
            }

            return Redirect::route('admin.games');

            //return Redirect::route('web.player')->with('id',$player_id);

        } else {
            return Redirect::route('admin.games.create')
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
        $game = Game::find($id);

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

        $arr_tags_nl = [];
        $arr_tags_en = [];

        // check current linked tags and
        // place them in separate arrays
        foreach($game->gameTags as $tag){

            if($tag->game_tag_lang == "NL"){
                $arr_tags_nl[] = $tag->game_tag_value;
            } else {
                $arr_tags_en[] = $tag->game_tag_value;
            }
        }

        $arr_features_nl = [];
        $arr_features_en = [];

        // check current linked features and
        // place them in separate arrays
        foreach($game->gameFeatures as $feature){

            if($feature->game_feature_lang == "NL"){
                $arr_features_nl[] = $feature; // complete object (will be generated differently from tags)
            } else {
                $arr_features_en[] = $feature;
            }
        }

        return View::make('admin/games/edit')
            ->with('game',$game)
            ->with('types',$types)
            ->with('difficulties',$difficulties)
            ->with('themes',$themes)
            ->with('functions',$functions)
            ->with('budgetgroups',$budgetgroups)
            ->with('players',$players)
            ->with('game_tags_nl',$arr_tags_nl)
            ->with('game_tags_en',$arr_tags_en)
            ->with('game_features_nl',$arr_features_nl)
            ->with('game_features_en',$arr_features_en);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $game = Game::find($id);

        $rules = [
            'title_nl' => 'required_without:title_en' ,
            'title_en' => 'required_without:title_nl',
            'age_nl' => 'required_without:age_en',
            'age_en' => 'required_without:age_nl',
            'producer' => 'required',
            'players' => 'required',
            'functions' => 'required',
            'icon' => 'image|mimes:jpg,jpeg,gif,png', // TODO : MEER?

        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values
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

            $game->game_modified = date("Y-m-d H:i:s");

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

                // image folder
                $destination = 'uploads/images';

                // check if there was an old image file
                if($game->game_image && $game->game_image !== ''){

                    // delete old image
                    unlink($destination . '/' . $game->game_image);

                }

                // upload new file

                // haal file upload
                $image = Input::file('image');

                $filename = $image->getClientOriginalName();

                // store image in folder
                Input::file('image')->move($destination, $filename);

                // store name in database
                $game->game_image = $filename;
            }

            // detach old functions
            foreach($game->gameFunctions as $old_function){

                $game->gameFunctions()->detach($old_function->game_function_id);
            }

            // attach new functions
            $functions = Input::get('functions');

            foreach($functions as $function){
                $game->gameFunctions()->attach($function);
            }

            // get new tags from input and remove whitespace

            $new_tags_nl_nws = str_replace(' ','',Input::get('tags_nl'));
            $new_tags_en_nws = str_replace(' ','',Input::get('tags_en'));

            $new_tags_nl = explode(',', $new_tags_nl_nws);
            $new_tags_en = explode(',', $new_tags_en_nws);

            // check old tags with new tags
            // keep track of existing tags

            $existing_tags_nl = [];
            $existing_tags_en = [];
            foreach($game->gameTags as $tag){

                if($tag->game_tag_lang == "NL"){

                    if (in_array($tag->game_tag_value, $new_tags_nl)) {
                        $existing_tags_nl[] = $tag->game_tag_value;
                    } else {
                        // delete old tag
                        GameTag::destroy($tag->game_tag_id);
                    }

                } else {

                    if (in_array($tag->game_tag_value, $new_tags_en)) {
                        $existing_tags_en[] = $tag->game_tag_value;
                    } else {
                        // delete old tag
                        GameTag::destroy($tag->game_tag_id);
                    }
                }
            }

            // add possible new tags
            foreach($new_tags_nl as $new_tag_nl){

                // check if new tag is not existing tag
                if (!in_array($new_tag_nl, $existing_tags_nl)) {

                    // check if not empty
                    if($new_tag_nl !== ''){

                        $new_tag = new GameTag();

                        $new_tag->game_tag_value = $new_tag_nl;
                        $new_tag->game_tag_lang = "NL";

                        $new_tag->save();

                        $game->gameTags()->attach($new_tag);

                    }
                }
            }

            foreach($new_tags_en as $new_tag_en){

                // check if new tag is not existing tag
                if (!in_array($new_tag_en, $existing_tags_en)) {

                    // check if not empty
                    if($new_tag_en !== ''){

                        $new_tag = new GameTag();

                        $new_tag->game_tag_value = $new_tag_en;
                        $new_tag->game_tag_lang = "EN";

                        $new_tag->save();

                        $game->gameTags()->attach($new_tag);

                    }
                }
            }

            // get new features from input and explode on line-breaks
            $new_features_nl_raw = explode(PHP_EOL, Input::get('features_nl'));
            $new_features_en_raw = explode(PHP_EOL, Input::get('features_en'));

            // array filter removes empty array values
            $new_features_nl_nws = array_filter($new_features_nl_raw);
            $new_features_en_nws = array_filter($new_features_en_raw);

            // array_map is necessary to make in_array check work
            $new_features_nl_mapped =  array_map('trim',$new_features_nl_nws);
            $new_features_en_mapped =  array_map('trim',$new_features_en_nws);

            // split and trim whitespace from both parts to build final features array

            $new_features_nl = [];
            $new_features_en = [];

            foreach($new_features_nl_mapped as $mapped_feature){

                // split mapped feature
                $mapped_feature_split = explode(',', $mapped_feature);

                // add trimmed value to array
                $new_features_nl[] = trim($mapped_feature_split[0]) . ',' . trim($mapped_feature_split[1]);

            }

            foreach($new_features_en_mapped as $mapped_feature){

                // split mapped feature
                $mapped_feature_split = explode(',', $mapped_feature);

                // add trimmed value to array
                $new_features_en[] = trim($mapped_feature_split[0]) . ',' . trim($mapped_feature_split[1]);

            }

            // check old features with new features
            // keep track of existing features

            $existing_features_nl = [];
            $existing_features_en = [];

            foreach($game->gameFeatures as $feature){

                if($feature->game_feature_lang == "NL"){

                    $concat_feature = $feature->game_feature_name . ',' . $feature->game_feature_value;

                    if (in_array($concat_feature, $new_features_nl)) {

                        $existing_features_nl[] = $concat_feature;

                    } else {

                        // delete old feature
                        GameFeature::destroy($feature->game_feature_id);
                    }

                } else {

                    $concat_feature = $feature->game_feature_name . ',' . $feature->game_feature_value;

                    if (in_array($concat_feature, $new_features_en)) {

                        $existing_features_en[] = $concat_feature;

                    } else {

                        // delete old feature
                        GameFeature::destroy($feature->game_feature_id);
                    }
                }
            }

            // add possible new features
            foreach($new_features_nl as $new_feature_nl){

                // check if new feature is not existing feature
                if (!in_array($new_feature_nl, $existing_features_nl)) {

                    $new_feature = new GameFeature();

                    $feature_split = explode(',', $new_feature_nl);

                    $new_feature->game_feature_name = $feature_split[0];
                    $new_feature->game_feature_value = $feature_split[1];
                    $new_feature->game_feature_lang = 'NL';

                    $new_feature->save();

                    $game->gameFeatures()->attach($new_feature);

                }
            }

            foreach($new_features_en as $new_feature_en){

                // check if new feature is not existing feature
                if (!in_array($new_feature_en, $existing_features_en)) {

                    $new_feature = new GameFeature();

                    $feature_split = explode(',', $new_feature_en);

                    $new_feature->game_feature_name = $feature_split[0];
                    $new_feature->game_feature_value = $feature_split[1];
                    $new_feature->game_feature_lang = 'EN';

                    $new_feature->save();

                    $game->gameFeatures()->attach($new_feature);

                }
            }

            // save changes
            $game->save();

            return Redirect::route('admin.games');

        } else {

            return Redirect::to('admin/games/edit/' . $game->game_id)
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
        // check if game has image

        $game = Game::find($id);

        // image folder
        $destination = 'uploads/images';

        // check if there was an old image file
        if($game->game_image && $game->game_image !== ''){

            // delete old image
            unlink($destination . '/' . $game->game_image);

        }

        // remove game
        Game::destroy($id);

        return Redirect::route('admin.games');
    }

    /**
     * Handles input from search form
     *
     * @return Response
     */
    public function searchSubmit(){

        // get string from search
        $str = strtolower(Input::get('search'));

        if($str == ''){

            return Redirect::route('admin.games');

        } else {

            return Redirect::to('admin/games/search/' . $str);

        }

    }

    /**
     * Search by string
     *
     * @param $str
     * @return Response
     */
    public function search($str){

        if($str == ''){

            return Redirect::route('admin.games');

        } else {

            // get matching results (for both languages)
            $games = Game::where('game_title_nl','like','%' . $str . '%')
                ->orWhere('game_title_en','like','%' . $str . '%')
                ->get();

            // get count of problems
            $count = $games->count();

            // redirect wth search results
            return View::make('admin/games/index')
                ->with('count', $count)
                ->with('search_results', $games);

        }

    }

}