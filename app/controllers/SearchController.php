<?php

class SearchController extends \BaseController {

    public function SearchFormIndex()
    {
        $q = Input::get('game');

        return Redirect::route('web.search', array($q));
    }

    public function FilterIndex($string = null)
    {
        $games = Game::all();

        if (App::getLocale() == 'nl')
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

            $game_kinds = GameKind::where('game_kind_name_nl','!=','')->lists('game_kind_name_nl','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_nl','game_difficulty_id');
            $game_themes = Theme::where('theme_name_nl','!=','')->lists('theme_name_nl','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_nl','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_nl','game_players_id');
            $game_age = Game::groupBy('game_age_nl')->lists('game_age_nl');

            if($string = null)
            {
                $game = Game::select('game_title_nl as game_title','game_description_nl as game_description');
            }
        }
        else
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

            $game_kinds = GameKind::where('game_kind_name_en','!=','')->lists('game_kind_name_en','game_kind_id');
            $game_difficulties = GameDifficulty::lists('game_difficulty_name_en','game_difficulty_id');
            $game_themes = Theme::where('theme_name_en','!=','')->lists('theme_name_en','theme_id');
            $game_functions = GameFunctionCategory::lists('game_function_category_name_en','game_function_category_id');
            $game_players = GamePlayers::lists('game_players_name_en','game_players_id');
            $game_age = Game::groupBy('game_age_en')->lists('game_age_en');
            if($string = null)
            {
                $game = Game::select('game_title_en as game_title','game_description_en as game_description');
            }
        }

        $game_producer = Game::groupBy('game_producer')->lists('game_producer');
        $game_budget = BudgetGroup::lists('budget_group_value','budget_group_id');

        return View::make('web.spelzoeken', compact('game_kinds','game_difficulties', 'game_producer','game_themes','game_functions','game_budget','game_players','game_age'),['games' => $game]);
    }

    public function FilterSearch()
    {

    }
}