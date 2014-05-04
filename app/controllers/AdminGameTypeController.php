<?php

class AdminGameTypeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all functions
        $count = GameType::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $types = GameType::orderBy('game_kind_id', 'asc')->orderBy('game_type_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $types = GameType::orderBy('game_kind_id', 'asc')->orderBy('game_type_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/types/index')
            ->with('types',$types)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // create appropriate ddl according to current locale
        if (App::getLocale() == 'nl')
        {
            $kinds = GameKind::lists('game_kind_name_nl','game_kind_id');
        }
        else {
            $kinds = GameKind::lists('game_kind_name_en','game_kind_id');
        }

        return View::make('admin/types/create')
            ->with('kinds', $kinds);
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
            'name_en' => 'required_without:name_nl',
            'kind' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            $type = new GameType();
            $type->game_type_name_nl = Input::get('name_nl');
            $type->game_type_name_en = Input::get('name_en');

            $kind = GameKind::find(Input::get('kind'));

            $type->gameKind()->associate($kind);

            $type->save();

            return Redirect::route('admin.types');

        } else {
            return Redirect::route('admin.types.create')
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
        GameType::destroy($id);

        return Redirect::route('admin.types');
    }

}