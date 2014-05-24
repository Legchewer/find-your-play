<?php

class AdminGameKindController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = GameKind::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $kinds = GameKind::orderBy('game_kind_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $kinds = GameKind::orderBy('game_kind_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/kinds/index')
            ->with('kinds',$kinds)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/kinds/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'name_nl' => 'required_without:name_en' ,
            'name_en' => 'required_without:name_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $kind = new GameKind();
            $kind->game_kind_name_nl = Input::get('name_nl');
            $kind->game_kind_name_en = Input::get('name_en');

            $kind->save();

            return Redirect::route('admin.kinds');

        } else {
            return Redirect::route('admin.kinds.create')
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
        $kind = GameKind::find($id);

        return View::make('admin/kinds/edit')
            ->with('kind',$kind);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $kind = GameKind::find($id);

        $rules = [
            'name_nl' => 'required_without:name_en' ,
            'name_en' => 'required_without:name_nl'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            // update data with $_POST values
            $kind->game_kind_name_nl = Input::get('name_nl');
            $kind->game_kind_name_en = Input::get('name_en');

            // save changes
            $kind->save();

            return Redirect::route('admin.kinds');

        } else {

            return Redirect::to('admin/kinds/edit/' . $kind->game_kind_id)
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
        GameKind::destroy($id);

        return Redirect::route('admin.kinds');
    }

}