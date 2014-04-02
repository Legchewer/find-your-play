<?php

class AdminMemberController extends \BaseController {


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

                // check if member role is admin
                if($auth_member->role->role_name_nl == 'admin'){

                    // manually check password

                    $auth_password = Input::get('password');

                    if(Hash::check($auth_password, $auth_member->member_password)){

                        // get remember value
                        $remember = (Input::get('remember') == 1 ? true : false);

                        // manual login (with remember)
                        Auth::login($auth_member, $remember);

                        Auth::user()->save();

                        return Redirect::route('admin.dashboard');

                    } else {
                        return Redirect::route('admin.login')
                            ->withInput()
                            ->with('auth-error-message', 'Incorrect username/password combination.');
                    }

                } else {
                    return Redirect::route('admin.login')
                        ->withInput()
                        ->with('auth-error-message', 'Not authorized.');
                }

            } else {

                return Redirect::route('admin.login')
                    ->withInput()
                    ->with('auth-error-message', 'User not found.');

            }

        } else {


            return Redirect::route('admin.login')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
        }
    }


}