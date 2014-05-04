<?php

class AdminGameController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        /*$games = Game::where('theme_id','=',1)->get();

        //var_dump($games); // altijd een collectie (zelfs voor één game)

        foreach($games as $game){
            var_dump($game->theme->theme_name_nl); // eloquent object // resultaat is 'boerderij'
        }*/

        /*$theme = Theme::find(1);

        $theme_games = $theme->games;

        //var_dump($theme_games); // altijd een collectie (zelfs voor één game)

        foreach($theme_games as $game){
            var_dump($game->game_title_nl); // 'nijntje vormenstoof'
        }*/

        // LIKE (met EAGER)

        //$themes = Theme::where('theme_name_nl','like','%boer%')->get();

        //var_dump($themes);

        /*foreach($themes as $theme){
            var_dump($theme->theme_name_nl);
        }*/

        $q = 'nergensin';

        $s = Game::
            where('game_title_en','LIKE','%' . $q . '%')
            ->orWhere('game_description_en','LIKE','%' . $q . '%')
            ->orWhere('game_producer','LIKE','%' . $q . '%')
            ->get();

        //var_dump($s);

        if(!$s->isEmpty()){
            echo "NOT EMPTY";
        } else {
            echo "EMPTY";
        }

        /*foreach($s as $game){
            var_dump($game->game_id); // 1
        }*/

        // get count of all games
        /*$count = Game::all()->count();

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
            ->with('count',$count);*/
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