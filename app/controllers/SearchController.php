<?php

class SearchController extends \BaseController {

    public function NameAndDescriptionSearch()
    {
        $q = Input::get('game');

        $games = Game::all();

        if (App::getLocale() == 'nl')
        {
            foreach($games as $s)
            {
                $s = $games->
                    where('game_title_nl','LIKE','%' . $q . '%')
                    ->orWhere('game_description_nl','LIKE','%' . $q . '%')
                    ->orWhere('game_producer','LIKE','%' . $q . '%')
                    ->with(array('theme' => function($query){
                            $q = Input::get('game');
                            $query->where('theme_name_nl','LIKE','%' . $q . '%');
                        }))
                    ->get();
            }
        }
        else
        {

            $theme_id = Theme::where('theme_name_en','like','%' . $q . '%')->get();
            if(!$theme_id->isEmpty())
            {
                foreach($games as $g)
                {
                    $g = Game::where('theme_id','=',$theme_id[0]->theme_id)->get();
                    var_dump($g);
                }
            }



            /*foreach($games as $s)
            {
                $s = Game::with(array('theme' => function($query){
                        $q = Input::get('game');
                        $query->where('theme_name_en','like','%'.$q.'%');
                    }))

                    /*->orWhere('game_title_en','LIKE','%' . $q . '%')
                    ->orWhere('game_description_en','LIKE','%' . $q . '%')
                    ->orWhere('game_producer','LIKE','%' . $q . '%')
                    ->get();
            }*/
        }
    }
}