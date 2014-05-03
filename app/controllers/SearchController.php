<?php

class SearchController extends \BaseController {

    public function NameSearch()
    {
        $q = Input::get('game');
        $games = DB::table('games');

        if (App::getLocale() == 'nl')
        {
            foreach($games as $s)
            {
                $s = DB::table('games')->where('game_title_nl','LIKE','%' . $q . '%')
                    ->orWhere('game_description_nl','LIKE','%' . $q . '%')
                    ->get();
            }
        }
        else
        {
            foreach($games as $s)
            {
                $s = DB::table('games')->where('game_title_en','LIKE','%' . $q . '%')
                    ->orWhere('game_description_en','LIKE','%' . $q . '%')
                    ->get();
            }
        }

        return Redirect::to('web/search',compact($s));
    }
}