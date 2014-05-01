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