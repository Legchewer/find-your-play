<?php

class AdminThemeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        /* get count of all info
        $count = Info::all()->count();

        // sort by name and paginate

        if (App::getLocale() == 'nl')
        {
            $info = Info::orderBy('species_id', 'asc')->orderBy('info_name_nl', 'asc')->paginate(10);

        }
        else
        {
            $info = Info::orderBy('species_id', 'asc')->orderBy('info_name_en', 'asc')->paginate(10);

        }*/

        return View::make('admin/themes/index');
            //->with('info',$info)
            //->with('count',$count);
	}

}