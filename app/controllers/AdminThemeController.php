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

}