<?php

class SearchController extends \BaseController {

    public function SearchFormIndex()
    {
        //vorige zoekqueries wissen
        Session::flush();

        $q = Input::get('game');

        // zoekquery index pagina
        Session::flash('index_search',$q);

        return Redirect::route('web.search');
    }

    public function FilterIndex()
    {
        // alle spellen
        $games = Game::all();

        // nederlands
        if(App::getLocale() == 'nl')
        {
            // selects opvullen
            $game_kinds = GameKind::where('game_kind_name_nl','!=','')->lists('game_kind_name_nl','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_nl','game_difficulty_id');
            $game_themes = Theme::where('theme_name_nl','!=','')->lists('theme_name_nl','theme_id');
            $game_functions = GameFunction::lists('game_function_name_nl','game_function_id');
            $game_players = GamePlayers::lists('game_players_name_nl','game_players_id');
            $game_age = Game::groupBy('game_age_nl')->lists('game_age_nl','game_age_nl');

            // als zoekquery index bestaat
            $search_index = Session::get('index_search');
            // zoekquery niet leeg
            if($search_index != '')
            {
                // alle thema's ophalen die zoek query kan bevatten
                $themes = Theme::where('theme_name_nl','like','%' . $search_index . '%')->get();
                // alle tags ophalen die zoek query kan bevatten
                $tags = GameTag::where('game_tag_value','like','%' . $search_index . '%')->get();
                // id ophalen van thema van zoekquery
                foreach($themes as $theme)
                {
                    $theme_id = $theme->theme_id;
                }
                foreach($tags as $tag)
                {
                    $tag_id = $tag->game_tag_id;
                }
                // als zoekquery thema was
                if(!$themes->isEmpty())
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('theme_id','=',$theme_id)
                            ->orWhere('game_title_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_description_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_producer','LIKE','%' . $search_index . '%')
                            ->select('game_id as game_id','game_title_nl as game_title','game_description_nl as game_description')
                            ->get();
                    }
                }
                else if(!$tags->isEmpty())
                {

                    $tag = GameTag::find($tag_id);
                    $taggedgames = $tag->games;

                    foreach($taggedgames as $g){
                        $game = $g->orWhere('game_title_nl','LIKE','%' . $search_index . '%')
                                  ->orWhere('game_description_nl','LIKE','%' . $search_index . '%')
                                  ->orWhere('game_producer','LIKE','%' . $search_index . '%')
                                  ->select('game_id as game_id','game_title_nl as game_title','game_description_nl as game_description')
                                  ->get();
                    }
                }
                // zoekquery was geen thema of tag, zoek op title, description, producer
                else
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('game_title_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_description_nl','LIKE','%' . $search_index . '%')
                            ->orWhere('game_producer','LIKE','%' . $search_index . '%')
                            ->select('game_id as game_id','game_title_nl as game_title','game_description_nl as game_description')
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

                foreach($games as $g)
                {
                   $game = $g->where(function($query)use($array)
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
                               if($array['budget'] != 'null'){
                                   $query->where('budget_group_id','=',$array['budget']);
                               }
                               if($array['players'] != 'null'){
                                   $query->where('game_players_id','=',$array['players']);
                               }
                               if($array['age'] != 'null'){
                                   $query->where('game_age_nl','=',$array['age']);
                               }
                               if($array['function'] != 'null'){
                                   $function = GameFunction::find($array['function']);
                                   $gamesWithFunctions = $function->games;

                                   foreach($gamesWithFunctions as $ga){
                                       $query->where('game_id','=',$ga->game_id);
                                   }
                               }
                               if($array['kind'] != 'null'){
                                   $kind = GameKind::find($array['kind']);
                                   $gamesWithKinds = $kind->gameTypes;
                                   $arrTypes = [];
                                   foreach($gamesWithKinds as $gk)
                                   {
                                       array_push($arrTypes,$gk->game_type_id);
                                   }
                                   var_dump($arrTypes);
                                   foreach($arrTypes as $gt){
                                       var_dump($gt);
                                       $query->where('game_type_id','=',$gt);
                                   }
                               }
                           })->select('game_id as game_id','game_title_nl as game_title','game_description_nl as game_description')
                             ->get();;
                }
            }

            if($search_index == null && $search == null)
            {
                foreach($games as $g)
                {
                    $game = $g->select('game_id as game_id','game_title_nl as game_title','game_description_nl as game_description')
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
            $game_functions = GameFunction::lists('game_function_name_en','game_function_id');
            $game_players = GamePlayers::lists('game_players_name_en','game_players_id');
            $game_age = Game::groupBy('game_age_en')->lists('game_age_en','game_age_en');

            foreach($games as $g)
            {
                $game = $g->select('game_id as game_id','game_title_en as game_title','game_description_en as game_description')
                          ->get();
            }
        }

        // beide talen hetzelfde in select
        $game_producer = Game::groupBy('game_producer')->lists('game_producer','game_producer');
        $game_budget = BudgetGroup::lists('budget_group_value','budget_group_id');

        return View::make('web.spelzoeken', compact('game_kinds','game_difficulties', 'game_producer','game_themes','game_functions','game_budget','game_players','game_age'),['games' => $game]);






        /*if(Session::has('index_search')){
            $string = Session::get('index_search');

            if (App::getLocale() == 'nl'){
                if($string != null){
                    $themes = Theme::where('theme_name_nl','like','%' . $string . '%')->get();
                    foreach($themes as $theme)
                    {
                        $id = $theme->theme_id;
                    }

                    if(!$themes->isEmpty())
                    {
                        foreach($games as $g)
                        {
                            $game = $g->where('theme_id','=',$id)
                                ->orWhere('game_title_nl','LIKE','%' . $string . '%')
                                ->orWhere('game_description_nl','LIKE','%' . $string . '%')
                                ->orWhere('game_producer','LIKE','%' . $string . '%')
                                ->select('game_title_nl as game_title','game_description_nl as game_description')
                                ->get();
                        }
                    }
                }
            }
        }
        else
        {
            if(App::getLocale() == 'nl')
            {
                foreach($games as $g)
                {
                    $game = $g->select('game_title_nl as game_title','game_description_nl as game_description')
                        ->get();
                }
            }
            else
            {
                foreach($games as $g)
                {
                    $game = $g->select('game_title_en as game_title','game_description_en as game_description')
                        ->get();
                }
            }

        }
        /*$search = Session::get('search_post');


        function multiexplode ($delimiters,$search) {

            $ready = str_replace($delimiters, $delimiters[0], $search);
            $launch = explode($delimiters[0], $ready);
            return  $launch;
        }
        if($search != null){
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
        }
        $game = Game::select('game_title_nl as game_title','game_description_nl as game_description')
            ->get();*/

        /*if (App::getLocale() == 'nl')
        {
            if($string != null)
            {
                $themes = Theme::where('theme_name_nl','like','%' . $string . '%')->get();
                foreach($themes as $theme)
                {
                    $id = $theme->theme_id;
                }

                if(!$themes->isEmpty())
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('theme_id','=',$id)
                            ->orWhere('game_title_nl','LIKE','%' . $string . '%')
                            ->orWhere('game_description_nl','LIKE','%' . $string . '%')
                            ->orWhere('game_producer','LIKE','%' . $string . '%')
                            ->select('game_title_nl as game_title','game_description_nl as game_description')
                            ->get();
                    }
                }
                else
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('game_title_nl','LIKE','%' . $string . '%')
                            ->orWhere('game_description_nl','LIKE','%' . $string . '%')
                            ->orWhere('game_producer','LIKE','%' . $string . '%')
                            ->select('game_title_nl as game_title','game_description_nl as game_description')
                            ->get();
                    }
                }
            }
            else
            {
                $game = Game::select('game_title_nl as game_title','game_description_nl as game_description');
            }
*/
            /*
        }
        else
        {
            if($string != null)
            {
                $themes = Theme::where('theme_name_en','like','%' . $string . '%')->get();
                foreach($themes as $theme)
                {
                    $id = $theme->theme_id;
                }
                if(!$themes->isEmpty())
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('theme_id','=',$id)
                            ->orWhere('game_title_en','LIKE','%' . $string . '%')
                            ->orWhere('game_description_en','LIKE','%' . $string . '%')
                            ->orWhere('game_producer','LIKE','%' . $string . '%')
                            ->select('game_title_en as game_title','game_description_en as game_description')
                            ->get();
                    }
                }
                else
                {
                    foreach($games as $g)
                    {
                        $game = $g->where('game_title_en','LIKE','%' . $string . '%')
                            ->orWhere('game_description_en','LIKE','%' . $string . '%')
                            ->orWhere('game_producer','LIKE','%' . $string . '%')
                            ->select('game_title_en as game_title','game_description_en as game_description')
                            ->get();
                    }
                }
            }
            else
            {
                $game = Game::select('game_title_en as game_title','game_description_en as game_description');
            }

            $game_kinds = GameKind::where('game_kind_name_en','!=','')->lists('game_kind_name_en','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_en','game_difficulty_id');
            $game_themes = Theme::where('theme_name_en','!=','')->lists('theme_name_en','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_en','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_en','game_players_id');
            $game_age = Game::groupBy('game_age_en')->lists('game_age_en','game_age_en');
        //}
*/
    }

    public function SearchFormSearch()
    {
        Session::flush();

        $game_kindPOST = Input::get('game_kind');
        $gt = GameKind::where('game_kind_id','=',$game_kindPOST)->lists('game_kind_id');
        $gt = array_shift($gt);
        if($game_kindPOST == null){$gt = "null";}

        $game_difficultyPOST = Input::get('game_difficulty');
        $gd = GameDifficulty::where('game_difficulty_id','=',$game_difficultyPOST)->lists('game_difficulty_id');
        $gd = array_shift($gd);
        if($game_difficultyPOST == null){$gd = "null";}

        $game_producerPOST = Input::get('game_producer');
        if($game_producerPOST == null){$game_producerPOST = "null";}

        $game_themePOST = Input::get('game_theme');
        $gtheme = Theme::where('theme_id','=',$game_themePOST)->lists('theme_id');
        $gtheme = array_shift($gtheme);
        if($game_themePOST == null){$gtheme = "null";}

        $game_functionPOST = Input::get('game_function');
        $gf = GameFunction::where('game_function_id','=',$game_functionPOST)->lists('game_function_id');
        $gf = array_shift($gf);
        if($game_functionPOST == null){$gf = "null";}

        $game_budgetPOST = Input::get('game_budget');
        $gb = BudgetGroup::where('budget_group_id','=',$game_budgetPOST)->lists('budget_group_id');
        $gb = array_shift($gb);
        if($game_budgetPOST == null){$gb = "null";}

        $game_playersPOST = Input::get('game_players');
        $gp = GamePlayers::where('game_players_id','=',$game_playersPOST)->lists('game_players_id');
        $gp = array_shift($gp);
        if($game_playersPOST == null){$gp = "null";}

        $game_agePOST = Input::get('game_age');
        if($game_agePOST == null){$game_agePOST = "null";}

        $searchterms = "kind=" .$gt . ".difficulty=" .$gd . ".producer=" . $game_producerPOST . ".theme=" . $gtheme . ".function=" . $gf . ".budget=" .$gb . ".players=" .$gp . ".age=" . $game_agePOST;

        Session::flash('search_post',$searchterms);

        return Redirect::route('web.search');
    }
}