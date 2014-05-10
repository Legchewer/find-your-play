<?php

class SearchController extends \BaseController {

    public function SearchFormIndex()
    {
        $q = Input::get('game');
        Session::flash('index_search',$q);

        return Redirect::route('web.search');
    }

    public function FilterIndex()
    {
        $search = Session::get('search_post');
        $string = Session::get('index_search');

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
        $games = Game::all();

        if (App::getLocale() == 'nl')
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

            $game_kinds = GameKind::where('game_kind_name_nl','!=','')->lists('game_kind_name_nl','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_nl','game_difficulty_id');
            $game_themes = Theme::where('theme_name_nl','!=','')->lists('theme_name_nl','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_nl','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_nl','game_players_id');
            $game_age = Game::groupBy('game_age_nl')->lists('game_age_nl','game_age_nl');
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
        }

        $game_producer = Game::groupBy('game_producer')->lists('game_producer','game_producer');
        $game_budget = BudgetGroup::lists('budget_group_value','budget_group_id');

        return View::make('web.spelzoeken', compact('game_kinds','game_difficulties', 'game_producer','game_themes','game_functions','game_budget','game_players','game_age'),['games' => $game]);
    }

    public function SearchFormSearch()
    {
        $game_kindPOST = Input::get('game_kind');
        $gt = GameKind::where('game_kind_id','=',$game_kindPOST)->lists('game_kind_name_nl');
        $gt = array_shift($gt);
        if($game_kindPOST == null){$gt = "null";}

        $game_difficultyPOST = Input::get('game_difficulty');
        $gd = GameDifficulty::where('game_difficulty_id','=',$game_difficultyPOST)->lists('game_difficulty_name_nl');
        $gd = array_shift($gd);
        if($game_difficultyPOST == null){$gd = "null";}

        $game_producerPOST = Input::get('game_producer');
        if($game_producerPOST == null){$game_producerPOST = "null";}

        $game_themePOST = Input::get('game_theme');
        $gtheme = Theme::where('theme_id','=',$game_themePOST)->lists('theme_name_nl');
        $gtheme = array_shift($gtheme);
        if($game_themePOST == null){$gtheme = "null";}

        $game_functionPOST = Input::get('game_function');
        $gf = GameFunctionCategory::where('game_function_category_id','=',$game_functionPOST)->lists('game_function_category_name_nl');
        $gf = array_shift($gf);
        if($game_functionPOST == null){$gf = "null";}

        $game_budgetPOST = Input::get('game_budget');
        $gb = BudgetGroup::where('budget_group_id','=',$game_budgetPOST)->lists('budget_group_value');
        $gb = array_shift($gb);
        if($game_budgetPOST == null){$gb = "null";}

        $game_playersPOST = Input::get('game_players');
        $gp = GamePlayers::where('game_players_id','=',$game_playersPOST)->lists('game_players_name_nl');
        $gp = array_shift($gp);
        if($game_playersPOST == null){$gp = "null";}

        $game_agePOST = Input::get('game_age');
        if($game_agePOST == null){$game_agePOST = "null";}

        $searchterms = "type=" .$gt . ".difficulty=" .$gd . ".producer=" . $game_producerPOST . ".theme=" . $gtheme . ".function=" . $gf . ".budget=" .$gb . ".players=" .$gp . ".age=" . $game_agePOST;
        Session::flash('search_post',$searchterms);

        return Redirect::route('web.search');
    }
}