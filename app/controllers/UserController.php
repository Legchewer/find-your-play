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
        $user = Auth::user()->person;
        $clients = Client::all();
        $clients='';

        return View::make('web.profiel', ['user' => $user, 'clients' => $clients]);
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
}