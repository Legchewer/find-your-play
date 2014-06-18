<?php

class UserController extends \BaseController {

    /**
     * Authorize user.
     *
     * @return Response
     */
    public function auth()
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $auth_email = Input::get('email');
            $auth_person = Person::where('person_email', '=', $auth_email)->first();
            // auth_person is null als het niet gevonden is
            if($auth_person !== null){
                // get member that corresponds with person
                $auth_member = Member::where('person_id', '=', $auth_person->person_id)->first();
                // manually check password
                $auth_password = Input::get('password');
                if(Hash::check($auth_password, $auth_member->member_password)){
                    Auth::login($auth_member, true);
                    Auth::user()->save();
                    return Redirect::route('web.index');
                } else {
                    return Redirect::route('web.index')
                        ->withInput()
                        ->with('auth-error-message', 'Het email adres of wachtwoord is ongeldig.');
                }
            } else {
                return Redirect::route('web.index')
                    ->withInput()
                    ->with('auth-error-message', 'De gebruiker werd niet gevonden');
            }
        } else {
            return Redirect::route('web.index')
                ->withInput()
                ->withErrors($validator);
        }
    }



    public function RegisterIndex(){
        if (App::getLocale() == 'nl')
        {
            $roles = Role::where('role_id','!=',1)->lists('role_name_nl','role_id');

        }
        else
        {
            $roles = Role::where('role_id','!=',1)->lists('role_name_en','role_id');

        }

        return View::make('web.registreren',compact('roles'));
    }
    public function SignInIndex()
    {
        return View::make('web.aanmelden');
    }

    public function Register()
    {
        $rules = [
            'givenname'       => 'required',
            'surname'         => 'required',
            'email'           => 'required|email|unique:persons,person_email',
            'password'        => 'required',
            'password_repeat' => 'same:password',
            'role'            => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $person = new Person;
            $person->person_givenname = Input::get('givenname');
            $person->person_surname = Input::get('surname');
            $person->person_email = Input::get('email');
            $person->save();

            $member = new Member;
            $member->member_password = Input::get('password');
            $member->person_id = $person->person_id;
            $member->role_id = Input::get('role');
            $member->save();

            return Redirect::to('web/index');

        } else {
            return Redirect::to('web/user/register')
                ->withInput()
                ->withErrors($validator);
        }
    }
    public function ProfileIndex(){
        $auth_user = Auth::user();
        $wishlist_games = [];
        // cookie terug uitlezen
        if(Cookie::get('wishlist')){
            $cookie_data = Cookie::get('wishlist');

            // id's omzetten naar array van Game objecten



            foreach($cookie_data as $id){

                array_push($wishlist_games, Game::find($id));

            }
        }

        return View::make('web.profiel', ['user' => $auth_user, 'wishlist' => $wishlist_games]);
    }
    public function Profile()
    {
        $rules = [
            'givenname' => 'required',
            'surname'   => 'required',
            'email'     => 'required|email'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $person = Person::find(Auth::user()->person_id);
            $person->person_givenname = Input::get('givenname');
            $person->person_surname = Input::get('surname');
            $person->person_email = Input::get('email');

            $person->save();

            return Redirect::route('web.edit');

        } else {
            return Redirect::route('web.edit')
                ->withInput()
                ->withErrors($validator);
        }
    }
    public function Index(){
        return View::make('web.index');
    }
    public function About(){
        return View::make('web.overons');
    }
    public function ClientGamesIndex($id){
        $client = Client::find($id);
        $clientgames = [];
        foreach($client->games as $g){
            array_push($clientgames,$g->game_id);
        }
        $games = Game::all();
        if(App::getLocale() == 'nl')
        {
            $games_list = [];

            foreach(Game::all() as $game){

                foreach($game->clients as $c){
                    if($c->client_id == $id){
                        // this doesn't work.. :/
                        /*if(!in_array($c->pivot->game_id, $clientgames)){

                        }*/
                        array_push($games_list, $game);
                    }
                }
            }
            foreach($games_list as $g)
            {
                $game = $g->lists('game_title_nl','game_id');
            }

        }else{
            $games_list = [];

            foreach(Game::all() as $game){

                foreach($game->clients as $client){

                    if($client->client_id !== $id){

                        array_push($games_list, $game);

                    }
                }
            }
            foreach($games_list as $g)
            {
                $game = $g->lists('game_title_en','game_id');
            }
        }
        return View::make('web.client-games', ['client' => $client],compact('game'));
    }
    public function ClientGames($id)
    {

        $rules = [
            'game'       => 'required',
            'usedate'    => 'required',
            'evaluation' => 'required',
            'duration'   => 'required',
            'log'        => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $game = Input::get('game');
            $date = Input::get('usedate');
            $evalution = Input::get('evaluation');
            $duration = Input::get('duration');
            $log = Input::get('log');


            $client = Client::find($id);
            $client->games()->attach($game, ['client_game_usedate'=>$date, 'client_game_evaluation'=>$evalution, 'client_game_duration'=>$duration, 'client_game_log'=>$log]);


            $client->save();

            return Redirect::route('web.player')->with('id',$id);

        } else {
            return Redirect::to('web/user/profile/player/' . $id)
                 ->withInput()
                 ->withErrors($validator);
        }
    }
    // show edit page
    public function ClientGamesEditIndex($player_id,$game_id){
        $client = Client::find($player_id);

        //foreach($client->games as $c)
        //{
            //if($c->game_id == $game_id && $c->pivot->client_id == $client->client_id)
            //{
                //$game = $c->pivot;
                $game = Game::lists('game_title_nl','game_id');
            //}
        //}
        return View::make('web.client-games-edit', ['client' => $client, 'game' => $game]);
    }
    // post edit page
    public function ClientGamesEdit($player_id,$game_id){
        $rules = [
            'usedate'    => 'required',
            'evaluation' => 'required',
            'duration'   => 'required',
            'log'        => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $date = Input::get('usedate');
            $evalution = Input::get('evaluation');
            $duration = Input::get('duration');
            $log = Input::get('log');


            $client = Client::find($player_id);
            $client->games()->sync(array($game_id, ['client_game_usedate'=>$date, 'client_game_evaluation'=>$evalution, 'client_game_duration'=>$duration, 'client_game_log'=>$log]));


            $client->save();

            return Redirect::to('web/user/profile/player/' . $player_id);

        }
        else {
            return Redirect::to('web/user/profile/player/' . $player_id . '/edit/' . $game_id)
                ->withInput()
                ->withErrors($validator);
        }
    }
}