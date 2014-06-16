<?php

class AdminMemberController extends \BaseController {


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get count of all functions
        $count = Member::all()->count();

        // sort by name and paginate

        // TODO : ordenen volgens person name (join nodig?)
        $members = Member::orderBy('member_id', 'asc')->paginate(10);


        return View::make('admin/members/index')
            ->with('members',$members)
            ->with('count',$count);
    }

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

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // rol is altijd admin

        return View::make('admin/members/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'person_email'    => 'required|email|unique:persons',
            'givenname' => 'required|min:2',
            'surname' => 'required|min:2',
            'password' => 'required|min:6',
            'repeat' => 'required|same:password'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // create new person
            $person = new Person();

            $person->person_email = Input::get('person_email');
            $person->person_givenname = Input::get('givenname');
            $person->person_surname = Input::get('surname');

            $person->save();

            // create new member
            $member = new Member();

            $member->member_password = Input::get('password'); // automatically hashes
            $member->member_created = date("Y-m-d H:i:s");

            $member->person()->associate($person);

            $role = Role::find(1); // role is always admin

            $member->role()->associate($role);

            $member->save();

            return Redirect::route('admin.members');

        } else {
            return Redirect::route('admin.members.create')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $member = Member::find($id);

        return View::make('admin/members/edit')
            ->with('member',$member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $member = Member::find($id);

        $rules = [
            'person_email'    => 'required|email',
            'givenname' => 'required|min:2',
            'surname' => 'required|min:2'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values
            $member->person->person_email = Input::get('person_email');
            $member->person->person_givenname = Input::get('givenname');
            $member->person->person_surname = Input::get('surname');

            $member->member_modified = date("Y-m-d H:i:s");

            // save changes
            $member->person->save(); // otherwise doesn't save?
            $member->save();

            return Redirect::route('admin.members');

        } else {

            return Redirect::to('admin/members/edit/' . $member->member_id)
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Show the form for changing the password.
     *
     * @return Response
     */
    public function changePassword()
    {
        $member = Auth::user();

        return View::make('admin/members/password')
            ->with('member',$member);
    }

    /**
     * Update the password.
     *
     * @return Response
     */
    public function passwordUpdate()
    {

        $member = Auth::user();

        $rules = [
            'old_password' => 'required',
            'old_repeat' => 'required|same:old_password',
            'password' => 'required|min:6',
            'repeat' => 'required|same:password'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $old_pw = Input::get('old_password');

            // check if password is correct
            if(Hash::check($old_pw, $member->member_password)){

                // update data with $_POST values

                $member->member_password = Hash::make(Input::get('password'));

                $member->member_modified = date("Y-m-d H:i:s");

                // save changes
                $member->save();

                return Redirect::route('admin.root');

            } else {

                // set error message based on language

                if (App::getLocale() == 'nl'){

                    return Redirect::to('admin/members/password')
                        ->withInput()
                        ->with('auth-error-message', 'Verkeerd wachtwoord');

                } else {

                    return Redirect::to('admin/members/password')
                        ->withInput()
                        ->with('auth-error-message', 'Wrong password');

                }

            }

        } else {

            return Redirect::to('admin/members/password')
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Member::destroy($id);

        return Redirect::route('admin.members');
    }


}