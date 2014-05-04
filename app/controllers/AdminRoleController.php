<?php

class AdminRoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all roles
        $count = Role::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $roles = Role::orderBy('role_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $roles = Role::orderBy('role_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/roles/index')
            ->with('roles',$roles)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/roles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'name_nl' => 'required' ,
            'name_en' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $role = new Role();
            $role->role_name_nl = Input::get('name_nl');
            $role->role_name_en = Input::get('name_en');

            $role->save();

            return Redirect::route('admin.roles');

        } else {
            return Redirect::route('admin.roles.create')
                ->withInput()
                ->withErrors($validator); // Maakt $errors in View.
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
        Role::destroy($id);

        return Redirect::route('admin.roles');
    }

}