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
                        ->with('auth-error-message', 'Incorrect username/password combination.');
                }
            } else {
                return Redirect::route('web.index')
                    ->withInput()
                    ->with('auth-error-message', 'User not found.');
            }
        } else {
            return Redirect::route('web.index')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
        }
    }


}