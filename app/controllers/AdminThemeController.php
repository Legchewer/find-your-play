<?php

class AdminThemeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get count of all themes
        $count = Theme::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $themes = Theme::orderBy('theme_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $themes = Theme::orderBy('theme_name_en', 'asc')->paginate(10);

        }

        return View::make('admin/themes/index')
            ->with('themes',$themes)
            ->with('count',$count);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('admin/themes/create');
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

            $theme = new Theme();
            $theme->theme_name_nl = Input::get('name_nl');
            $theme->theme_name_en = Input::get('name_en');

            $theme->save();

            return Redirect::route('admin.themes');

        } else {
            return Redirect::route('admin.themes.create')
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
        Theme::destroy($id);

        return Redirect::route('admin.themes');
    }

}