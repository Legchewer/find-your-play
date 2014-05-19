<?php

class ClientController extends \BaseController {

    public function RegisterIndex(){

        return View::make('web.client-register');
    }
    public function Register(){
        $rules = [
            'givenname'       => 'required',
            'surname'         => 'required',
            'email'           => 'required|email|unique:persons,person_email'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            $user = Auth::user()->person;

            $person = new Person;
            $person->person_givenname = Input::get('givenname');
            $person->person_surname = Input::get('surname');
            $person->person_email = Input::get('email');
            $person->save();

            $client = new Client();
            $client->client_experience = Input::get('experience');
            $client->person_id = $person->person_id;
            $client->save();

            $memberClient = Client::where('person_id','=',$client->person_id)->get();
            $client = Client::find($memberClient[0]->client_id);
            $client->members()->attach($user->person_id);

            return Redirect::to('web/user/profile');

        } else {
            return Redirect::to('web/user/profile/register/client')
                ->withInput()
                ->withErrors($validator);
        }
    }
}