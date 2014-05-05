<?php

class SearchController extends \BaseController {

    public function NameAndDescriptionSearch()
    {
        $q = Input::get('game');

        $games = Game::all();

        if (App::getLocale() == 'nl')
        {
            $themes = Theme::where('theme_name_nl','like','%' . $q . '%')->get();
            foreach($themes as $theme)
            {
                $id = $theme->theme_id;
            }
            if(!$themes->isEmpty())
            {
                foreach($games as $g)
                {
                    $game = $g->where('theme_id','=',$id)
                        ->orWhere('game_title_nl','LIKE','%' . $q . '%')
                        ->orWhere('game_description_nl','LIKE','%' . $q . '%')
                        ->orWhere('game_producer','LIKE','%' . $q . '%')
                        ->select('game_title_nl as game_title','game_description_nl as game_description')
                        ->get();
                }
            }
            else
            {
                foreach($games as $g)
                {
                    $game = $g->where('game_title_nl','LIKE','%' . $q . '%')
                        ->orWhere('game_description_nl','LIKE','%' . $q . '%')
                        ->orWhere('game_producer','LIKE','%' . $q . '%')
                        ->select('game_title_nl as game_title','game_description_nl as game_description')
                        ->get();
                }
            }
        }
        else
        {

            $themes = Theme::where('theme_name_en','like','%' . $q . '%')->get();
            foreach($themes as $theme)
            {
                $id = $theme->theme_id;
            }
            if(!$themes->isEmpty())
            {
                foreach($games as $g)
                {
                    $game = $g->where('theme_id','=',$id)
                              ->orWhere('game_title_en','LIKE','%' . $q . '%')
                              ->orWhere('game_description_en','LIKE','%' . $q . '%')
                              ->orWhere('game_producer','LIKE','%' . $q . '%')
                              ->select('game_title_en as game_title','game_description_en as game_description')
                              ->get();
                }
            }
            else
            {
                foreach($games as $g)
                {
                    $game = $g->where('game_title_en','LIKE','%' . $q . '%')
                        ->orWhere('game_description_en','LIKE','%' . $q . '%')
                        ->orWhere('game_producer','LIKE','%' . $q . '%')
                        ->select('game_title_en as game_title','game_description_en as game_description')
                        ->get();
                }
            }
        }
        return View::make('web.spelzoeken', ['games' => $game]);
    }

    public function Filter()
    {
        return View::make('web.spelzoeken');
    }
}